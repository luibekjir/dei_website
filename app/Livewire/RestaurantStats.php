<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;
use Carbon\Carbon;

class RestaurantStats extends Component
{
    public $restaurantId;

    public function mount($restaurantId)
    {
        $this->restaurantId = $restaurantId;
    }

    public function getStatsProperty()
    {
        $today = Carbon::today();
        $thisMonth = Carbon::now()->startOfMonth();
        
        return [
            'revenue_today' => Order::where('created_at', '>=', $today)
                ->whereIn('status', [Order::STATUS_COMPLETED, Order::STATUS_DELIVERED])
                ->sum('total'),
            'orders_today' => Order::where('created_at', '>=', $today)->count(),
            'revenue_month' => Order::where('created_at', '>=', $thisMonth)
                ->whereIn('status', [Order::STATUS_COMPLETED, Order::STATUS_DELIVERED])
                ->sum('total'),
            'avg_order_value' => Order::whereIn('status', [Order::STATUS_COMPLETED, Order::STATUS_DELIVERED])
                ->avg('total') ?? 0,
        ];
    }

    public function render()
    {
        return view('livewire.restaurant-stats', [
            'stats' => $this->stats
        ]);
    }
}
