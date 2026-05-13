<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Restaurant;
use App\Models\MenuItem;

class RestaurantShow extends Component
{
    public $restaurant;
    public $highlightId;
    public $highlightedMenu;
    public $cartCount = 0;

    public function mount($restaurantId, $highlightId = null)
    {
        $this->restaurant = Restaurant::with(['category', 'menuItems', 'city', 'reviews.user'])->findOrFail($restaurantId);
        $this->highlightId = $highlightId;
        
        if ($this->highlightId) {
            $this->highlightedMenu = MenuItem::find($this->highlightId);
        }

        $this->updateCartCount();
    }

    public function addToOrder($itemId)
    {
        $item = MenuItem::findOrFail($itemId);
        $cart = session()->get('cart', []);

        // Check for different restaurant
        if (!empty($cart)) {
            $firstItem = reset($cart);
            if ($firstItem['restaurant_id'] != $this->restaurant->id) {
                $this->dispatch('notify', [
                    'message' => 'Satu pesanan hanya boleh dari satu restoran. Harap kosongkan keranjang Anda terlebih dahulu.',
                    'type' => 'error'
                ]);
                return;
            }
        }

        if (isset($cart[$itemId])) {
            $cart[$itemId]['quantity']++;
        } else {
            $cart[$itemId] = [
                'name' => $item->name,
                'price' => $item->price,
                'quantity' => 1,
                'restaurant_id' => $this->restaurant->id,
                'image' => $item->image ? asset('storage/' . $item->image) : 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?auto=format&fit=crop&w=500&q=80'
            ];
        }

        session()->put('cart', $cart);
        $this->updateCartCount();
        $this->dispatch('notify', ['message' => $item->name . ' added to order!']);
    }

    private function updateCartCount()
    {
        $cart = session()->get('cart', []);
        $this->cartCount = array_sum(array_column($cart, 'quantity'));
    }

    public function render()
    {
        return view('livewire.restaurant-show');
    }
}
