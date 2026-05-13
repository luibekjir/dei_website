<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;
use App\Models\Review;
use Livewire\Attributes\On;

class ReviewComponent extends Component
{
    public $orderId;
    public $restaurantId;
    public $rating = 5;
    public $comment = '';
    public $showModal = false;

    #[On('openReviewModal')]
    public function openModal($orderId)
    {
        $order = Order::find($orderId);
        if ($order && $order->user_id === auth()->id() && $order->status === 'completed') {
            $this->orderId = $orderId;
            $this->restaurantId = $order->restaurant_id;
            $this->showModal = true;
        }
    }

    public function submitReview()
    {
        $this->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        // Prevent duplicate reviews for the same order
        if (Review::where('order_id', $this->orderId)->exists()) {
            $this->dispatch('notify', ['message' => 'You have already reviewed this order.', 'type' => 'error']);
            $this->showModal = false;
            return;
        }

        Review::create([
            'user_id' => auth()->id(),
            'restaurant_id' => $this->restaurantId,
            'order_id' => $this->orderId,
            'rating' => $this->rating,
            'comment' => $this->comment,
        ]);

        $this->showModal = false;
        $this->reset(['rating', 'comment']);
        $this->dispatch('notify', ['message' => 'Review submitted successfully!']);
    }

    public function render()
    {
        return view('livewire.review-component');
    }
}
