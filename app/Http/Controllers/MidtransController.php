<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MidtransController extends Controller
{
    public function notification(Request $request)
    {
        $payload = $request->getContent();
        $notification = json_decode($payload);

        $validSignatureKey = hash("sha512", $notification->order_id . $notification->status_code . $notification->gross_amount . env('MIDTRANS_SERVER_KEY'));

        if ($notification->signature_key != $validSignatureKey) {
            return response(['message' => 'Invalid signature'], 403);
        }

        $order = Order::where('midtrans_order_id', $notification->order_id)->first();
        if (!$order) {
            Log::warning('Midtrans Notification: Order not found for ' . $notification->order_id);
            return response(['message' => 'Order not found'], 404);
        }

        $transaction = $notification->transaction_status;
        $type = $notification->payment_type;
        $fraud = $notification->fraud_status;

        $oldStatus = $order->status;

        if ($transaction == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    $order->update(['status' => 'pending']);
                } else {
                    $order->update(['status' => 'confirmed']);
                }
            }
        } else if ($transaction == 'settlement') {
            $order->update(['status' => 'confirmed']);
        } else if ($transaction == 'pending') {
            $order->update(['status' => 'pending']);
        } else if ($transaction == 'deny') {
            $order->update(['status' => 'cancelled']);
        } else if ($transaction == 'expire') {
            $order->update(['status' => 'cancelled']);
        } else if ($transaction == 'cancel') {
            $order->update(['status' => 'cancelled']);
        }

        // Add to restaurant balance if just confirmed
        if ($order->status == 'confirmed' && $oldStatus != 'confirmed') {
            if ($order->restaurant) {
                $order->restaurant->increment('balance', $order->total);
                Log::info("Balance added to restaurant {$order->restaurant->name}: {$order->total}");
            }
        }

        return response(['message' => 'Notification processed']);
    }
}
