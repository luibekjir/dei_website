<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;

class OrderComponent extends Component
{
    public $items = [];
    public $subtotal = 0;
    public $taxes = 0;
    public $deliveryFee = 0;
    public $negotiatedDeliveryFee = 0;
    public $negotiationMessage;
    public $negotiationStatus = 'none';
    public $total = 0;
    public $orderType = 'delivery';
    public $restaurant;

    public function mount()
    {
        // Load from session cart
        $this->items = session()->get('cart', []);
        
        $restaurantId = !empty($this->items) ? reset($this->items)['restaurant_id'] : null;
        $this->restaurant = $restaurantId ? \App\Models\Restaurant::find($restaurantId) : null;

        if ($this->restaurant) {
            // Default to pickup if delivery is not available
            if (!$this->restaurant->has_delivery && $this->restaurant->supports_pickup) {
                $this->orderType = 'pickup';
            }
        }

        $this->calculateTotal();
        $this->negotiatedDeliveryFee = $this->deliveryFee;
    }

    public function setOrderType($type)
    {
        if (in_array($type, ['delivery', 'pickup'])) {
            $this->orderType = $type;
            $this->calculateTotal();
            $this->negotiatedDeliveryFee = $this->deliveryFee;
            $this->negotiationStatus = 'none';
        }
    }

    public function updateQuantity($index, $quantity)
    {
        if ($quantity < 1) return;
        $this->items[$index]['quantity'] = $quantity;
        session()->put('cart', $this->items);
        $this->calculateTotal();
    }

    public function removeItem($index)
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items);
        session()->put('cart', $this->items);
        $this->calculateTotal();
    }

    public function negotiateDeliveryFee()
    {
        if ($this->negotiatedDeliveryFee <= 0 || $this->negotiatedDeliveryFee === $this->deliveryFee) {
            return;
        }

        $this->negotiationStatus = 'pending';
        $this->negotiationMessage = "Proposed delivery fee: " . number_format($this->negotiatedDeliveryFee, 0, ',', '.') . " IDR";
    }

    public function acceptNegotiation()
    {
        $this->negotiationStatus = 'accepted';
        $this->deliveryFee = $this->negotiatedDeliveryFee;
        $this->calculateTotal();
    }

    public function rejectNegotiation()
    {
        $this->negotiationStatus = 'rejected';
        $this->negotiatedDeliveryFee = $this->deliveryFee;
        $this->negotiationMessage = null;
    }

    public function adjustNegotiatedFee($delta)
    {
        $this->negotiatedDeliveryFee = max(1000, $this->negotiatedDeliveryFee + $delta);
    }

    public function simulateDriverResponse()
    {
        // Simulate random driver response
        if (rand(0, 1)) {
            $this->acceptNegotiation();
        } else {
            $this->rejectNegotiation();
        }
    }

    public $paymentStatus = 'idle'; // idle, processing, success, failed
    public $qrCodeUrl = null;
    public $currentOrderId = null;
    public $paymentTimer = 0;

    public function startPayment()
    {
        if (empty($this->items)) return;

        $this->paymentStatus = 'processing';
        $this->qrCodeUrl = null;

        // Midtrans Configuration
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;
        
        \Midtrans\Config::$isProduction = (bool) env('MIDTRANS_IS_PRODUCTION', false);

        // Custom cURL options: IPv4 for stability, SSL verification in production
        \Midtrans\Config::$curlOptions = [
            CURLOPT_SSL_VERIFYPEER => \Midtrans\Config::$isProduction,
            CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4,
            CURLOPT_HTTPHEADER => [], // Fix for SDK bug: Undefined array key 10023
        ];

        $this->currentOrderId = 'ORDER-' . time() . '-' . auth()->id();

        $params = [
            'payment_type' => 'gopay',
            'transaction_details' => [
                'order_id' => $this->currentOrderId,
                'gross_amount' => (int)$this->total,
            ],
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ],
        ];

        try {
            $response = \Midtrans\CoreApi::charge($params);
            
            \Illuminate\Support\Facades\Log::info('Midtrans Response: ' . json_encode($response));
            if (isset($response->actions)) {
                foreach ($response->actions as $action) {
                    if ($action->name === 'generate-qr-code' || $action->name === 'generate-qr') {
                        $this->qrCodeUrl = $action->url;
                        break;
                    }
                }
            }
            
            if (!$this->qrCodeUrl) {
                throw new \Exception('Failed to generate QR Code from Midtrans response.');
            }

            $this->paymentStatus = 'awaiting-payment';
            $this->paymentTimer = 900;
            \Illuminate\Support\Facades\Log::info('QR URL successfully set: ' . $this->qrCodeUrl);
            $this->dispatch('payment-started');

        } catch (\Exception $e) {
            $this->paymentStatus = 'idle';
            \Illuminate\Support\Facades\Log::error('Midtrans API Error: ' . $e->getMessage());
            $this->dispatch('notify', [
                'message' => 'Payment Error: ' . $e->getMessage() . '. Cek log untuk detail.', 
                'type' => 'error'
            ]);
        }
    }
    public function checkPaymentStatus()
    {
        if (!$this->qrCodeUrl) return;

        // Extract order_id from current session or track it
        // For simplicity, we search for the latest pending order of the user
        // Or we could store it in a property. Let's add a property $currentOrderId.

        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);

        try {
            // We need to store the orderId we sent to Midtrans
            // I'll add a public $currentOrderId property to the class.
            if (!$this->currentOrderId) return;

            $status = \Midtrans\Transaction::status($this->currentOrderId);
            
            if ($status->transaction_status == 'settlement' || $status->transaction_status == 'capture') {
                $this->completePayment();
            } else {
                $this->dispatch('notify', [
                    'message' => 'Status: ' . $status->transaction_status,
                    'type' => 'info'
                ]);
            }
        } catch (\Exception $e) {
            $this->dispatch('notify', [
                'message' => 'Gagal cek status: ' . $e->getMessage(),
                'type' => 'error'
            ]);
        }
    }

    public function completePayment()
    {
        $this->paymentStatus = 'success';
        $this->checkout();
    }

    public function checkout()
    {
        if (empty($this->items)) return;

        $restaurantId = !empty($this->items) ? reset($this->items)['restaurant_id'] : null;

        // Create actual order record in DB
        $order = Order::create([
            'restaurant_id' => $restaurantId,
            'user_id' => auth()->id(),
            'items' => $this->items,
            'subtotal' => $this->subtotal,
            'taxes' => $this->taxes,
            'delivery_fee' => $this->deliveryFee,
            'total' => $this->total,
            'status' => $this->paymentStatus === 'success' ? 'confirmed' : 'pending',
            'type' => $this->orderType,
            'midtrans_order_id' => $this->currentOrderId,
        ]);

        session()->forget('cart');
        return redirect()->route('dashboard')->with('success', 'Pemesanan berhasil! Pesanan Anda sedang disiapkan.');
    }

    private function calculateTotal()
    {
        $this->subtotal = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $this->items));
        $this->taxes = $this->subtotal * 0.1; // 10% tax
        
        if ($this->orderType === 'pickup') {
            $this->deliveryFee = 0;
        } else {
            // Calculate flexible delivery fee
            $baseFee = 19000;
            $itemsCount = array_sum(array_column($this->items, 'quantity'));
            
            if ($this->restaurant) {
                $rules = $this->restaurant->deliveryRules()->where('is_active', true)->get();
                $bestFee = $baseFee;
                
                foreach ($rules as $rule) {
                    $calculated = $rule->calculateFee($itemsCount, $this->subtotal, $baseFee);
                    if ($calculated < $bestFee) {
                        $bestFee = $calculated;
                    }
                }
                $this->deliveryFee = $bestFee;
            } else {
                $this->deliveryFee = $baseFee;
            }
        }

        $this->total = $this->subtotal + $this->taxes + $this->deliveryFee;
    }

    public function render()
    {
        return view('livewire.order-component');
    }
}
