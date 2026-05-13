<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Validator;

class RestaurantDeliveryConfig extends Component
{
    public $restaurantId;
    public $hasDelivery;
    public $supportsPickup;
    public $deliveryStatus;

    public function mount($restaurantId)
    {
        $restaurant = Restaurant::findOrFail($restaurantId);
        $this->restaurantId = $restaurant->id;
        $this->hasDelivery = $restaurant->has_delivery;
        $this->supportsPickup = $restaurant->supports_pickup;
        $this->deliveryStatus = $restaurant->delivery_status;
    }

    public function save()
    {
        $data = $this->validate([
            'hasDelivery' => 'required|boolean',
            'supportsPickup' => 'required|boolean',
            'deliveryStatus' => 'required|in:available,busy,offline',
        ]);

        $restaurant = Restaurant::findOrFail($this->restaurantId);
        $restaurant->update([
            'has_delivery' => $data['hasDelivery'],
            'supports_pickup' => $data['supportsPickup'],
            'delivery_status' => $data['deliveryStatus'],
        ]);

        $this->dispatch('toast', 'Delivery configuration saved successfully.');
    }

    public function render()
    {
        return view('livewire.restaurant-delivery-config');
    }
}
