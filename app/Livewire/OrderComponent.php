<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;

class OrderComponent extends Component
{
    public $items = [];
    public $subtotal = 330000;
    public $taxes = 33000;
    public $deliveryFee = 19000;
    public $negotiatedDeliveryFee = 19000;
    public $negotiationMessage;
    public $negotiationStatus = 'none';
    public $total = 382000;

    public function mount()
    {
        // Initialize with sample data
        $this->items = [
            [
                'name' => 'Miso-Glazed Salmon',
                'price' => 145000,
                'quantity' => 1,
                'image' => 'https://images.unsplash.com/photo-1514516870920-364f6ea4b4a8?auto=format&fit=crop&w=500&q=80'
            ],
            [
                'name' => 'Truffle Pasta',
                'price' => 185000,
                'quantity' => 1,
                'image' => 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?auto=format&fit=crop&w=500&q=80'
            ]
        ];

        $this->deliveryFee = 19000;
        $this->negotiatedDeliveryFee = $this->deliveryFee;
        $this->calculateTotal();
    }

    public function updateQuantity($index, $quantity)
    {
        if ($quantity < 1) return;
        $this->items[$index]['quantity'] = $quantity;
        $this->calculateTotal();
    }

    public function removeItem($index)
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items);
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

    private function calculateTotal()
    {
        $this->subtotal = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $this->items));
        $this->taxes = $this->subtotal * 0.1; // 10% tax
        $this->total = $this->subtotal + $this->taxes + $this->deliveryFee;
    }

    public function render()
    {
        return view('livewire.order-component');
    }
}