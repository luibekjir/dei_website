<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;
use Livewire\Attributes\Title;

#[Title('Manage Restaurant')]
class ManageRestaurant extends Component
{
    public Restaurant $restaurant;
    public string $activeTab = 'stats';

    public function mount(Restaurant $restaurant)
    {
        // Check ownership
        if ($restaurant->user_id !== Auth::id()) {
            abort(403);
        }

        $this->restaurant = $restaurant;
    }

    public function setTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function toggleReviewVisibility($id)
    {
        $review = Review::where('restaurant_id', $this->restaurant->id)->findOrFail($id);
        $review->is_visible = !$review->is_visible;
        $review->save();
        $this->dispatch('notify', ['message' => 'Review visibility updated!']);
    }

    public function render()
    {
        return view('livewire.manage-restaurant')
            ->layout('layouts.app');
    }
}
