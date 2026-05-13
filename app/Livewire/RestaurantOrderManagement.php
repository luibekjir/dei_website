<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;

class RestaurantOrderManagement extends Component
{
    public $restaurantId;
    public $filter = 'active'; // active, pickup, delivery, history

    public function mount($restaurantId)
    {
        $this->restaurantId = $restaurantId;
    }

    public function getOrdersProperty()
    {
        $query = Order::query()
            ->where('restaurant_id', $this->restaurantId)
            ->latest();

        if ($this->filter === 'active') {
            $query->whereNotIn('status', [Order::STATUS_COMPLETED, Order::STATUS_DELIVERED]);
        } elseif ($this->filter === 'pickup') {
            $query->where('status', Order::STATUS_READY_FOR_PICKUP);
        } elseif ($this->filter === 'delivery') {
            $query->where('status', Order::STATUS_ON_DELIVERY);
        } elseif ($this->filter === 'history') {
            $query->whereIn('status', [Order::STATUS_COMPLETED, Order::STATUS_DELIVERED]);
        }

        return $query->get();
    }

    public function setFilter($filter)
    {
        $this->filter = $filter;
    }

    public function updateStatus($orderId, $status)
    {
        $order = Order::find($orderId);
        if ($order) {
            $order->status = $status;
            $order->save();
            $this->dispatch('notify', ['message' => 'Order status updated to ' . $status]);
        }
    }

    public function render()
    {
        return view('livewire.restaurant-order-management', [
            'orders' => $this->orders
        ]);
    }
}
