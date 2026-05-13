<?php

namespace App\Livewire\Pages\User;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\Province;
use App\Models\City;
use App\Models\Order;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

#[Title('User Profile')]
class Profile extends Component
{
    use WithFileUploads;
    public string $activeTab = 'dashboard';
    
    public $name;
    public $email;
    public $province_id;
    public $city_id;
    public $avatar;

    // Address properties
    public $address_label;
    public $address_line;
    public $address_city;
    public $address_state;
    public $address_province;
    public $address_postal_code;
    public $latitude;
    public $longitude;
    public $showAddressModal = false;

    // Restaurant properties
    public $showRestaurantModal = false;
    public $res_name;
    public $res_description;
    public $res_category_id;
    public $res_address;
    public $res_latitude;
    public $res_longitude;
    public $res_province_id;
    public $res_city_id;
    public $res_image;

    public function mount(): void
    {
        $user = auth()->user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->province_id = $user->province_id;
        $this->city_id = $user->city_id;
    }

    public function setTab(string $tab): void
    {
        $this->activeTab = $tab;
    }

    public function updatedProvinceId()
    {
        $this->city_id = null;
    }

    public function updatedResProvinceId()
    {
        $this->res_city_id = null;
    }

    public function addRestaurant()
    {
        $this->validate([
            'res_name' => 'required|min:3',
            'res_description' => 'required',
            'res_category_id' => 'required',
            'res_province_id' => 'required',
            'res_city_id' => 'required',
            'res_address' => 'required',
            'res_image' => 'nullable|image|max:2048',
        ]);

        $imagePath = $this->res_image ? $this->res_image->store('restaurants', 'public') : null;

        auth()->user()->restaurants()->create([
            'name' => $this->res_name,
            'description' => $this->res_description,
            'category_id' => $this->res_category_id,
            'province_id' => $this->res_province_id,
            'city_id' => $this->res_city_id,
            'address' => $this->res_address,
            'image' => $imagePath,
            'latitude' => $this->res_latitude ?? -7.2858,
            'longitude' => $this->res_longitude ?? 112.6313,
            'rating' => 5.0,
        ]);

        $this->reset(['res_name', 'res_description', 'res_category_id', 'res_province_id', 'res_city_id', 'res_address', 'res_latitude', 'res_longitude', 'res_image', 'showRestaurantModal']);
        $this->dispatch('notify', ['message' => 'Restaurant successfully registered!']);
    }

    public function saveProfile()
    {
        $user = auth()->user();
        $user->update([
            'name' => $this->name,
            'province_id' => $this->province_id,
            'city_id' => $this->city_id,
            'profile_completed' => true,
        ]);

        if ($this->avatar) {
            $avatarPath = $this->avatar->store('avatars', 'public');
            $user->update(['profile_photo_path' => $avatarPath]);
        }

        $this->dispatch('notify', ['message' => 'Profile updated successfully!']);
    }

    public function addAddress()
    {
        $this->validate([
            'address_label' => 'required',
            'address_line' => 'required',
            'address_city' => 'required',
        ]);

        auth()->user()->addresses()->create([
            'label' => $this->address_label,
            'address_line' => $this->address_line,
            'city' => $this->address_city,
            'state' => $this->address_province, // Using state field for province
            'postal_code' => $this->address_postal_code,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ]);

        $this->reset(['address_label', 'address_line', 'address_city', 'address_province', 'address_postal_code', 'latitude', 'longitude', 'showAddressModal']);
        $this->dispatch('notify', ['message' => 'Address added successfully!']);
    }

    public function deleteAddress($id)
    {
        auth()->user()->addresses()->where('id', $id)->delete();
        $this->dispatch('notify', ['message' => 'Address deleted!']);
    }

    public function render()
    {
        $user = auth()->user();
        
        // Calculate weekly spending
        $weeklySpending = Order::where('user_id', $user->id)
            ->where('created_at', '>=', now()->subDays(7))
            ->sum('total');

        return view('livewire.pages.user.profile', [
            'provinces' => Province::all(),
            'cities' => City::where('province_id', $this->province_id)->get(),
            'resCities' => City::where('province_id', $this->res_province_id)->get(),
            'categories' => Category::all(),
            'recentOrders' => Order::with('restaurant')
                ->where('user_id', $user->id)
                ->latest()
                ->take(5)
                ->get(),
            'allOrders' => Order::with(['restaurant', 'review'])
                ->where('user_id', $user->id)
                ->latest()
                ->get(),
            'savedAddresses' => $user->addresses,
            'weeklySpending' => $weeklySpending,
            'userRestaurants' => $user->restaurants()->with('category')->latest()->get(),
        ])->layout('layouts.app');
    }
}
