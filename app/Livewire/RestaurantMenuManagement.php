<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Restaurant;
use Livewire\WithFileUploads;

class RestaurantMenuManagement extends Component
{
    use WithFileUploads;
    public $restaurantId;
    public $menuName = '';
    
    public $itemName = '';
    public $itemDescription = '';
    public $itemPrice = 0;
    public $itemProvinceId = null;
    public $itemCityId = null;
    public $selectedMenuId = null;
    public $itemImage;
    public $editingItemId = null;

    public $showItemForm = false;

    public function mount($restaurantId)
    {
        $this->restaurantId = $restaurantId;
    }

    public function getMenusProperty()
    {
        return Menu::where('restaurant_id', $this->restaurantId)
            ->with('items')
            ->get();
    }

    public function deleteMenu($id)
    {
        Menu::find($id)->delete();
    }

    public function openItemForm($menuId)
    {
        $this->selectedMenuId = $menuId;
        $this->showItemForm = true;
    }

    public function addItem()
    {
        $city = \App\Models\City::find($this->itemCityId);
        $heritageName = $city ? $city->name : 'General';

        $menu = Menu::firstOrCreate([
            'restaurant_id' => $this->restaurantId,
            'name' => $heritageName
        ]);

        $imagePath = $this->itemImage ? $this->itemImage->store('menu-items', 'public') : null;

        MenuItem::create([
            'restaurant_id' => $this->restaurantId,
            'menu_id' => $menu->id,
            'name' => $this->itemName,
            'description' => $this->itemDescription,
            'price' => $this->itemPrice,
            'province_id' => $this->itemProvinceId,
            'city_id' => $this->itemCityId,
            'image' => $imagePath,
            'available' => true
        ]);

        $this->reset(['itemName', 'itemDescription', 'itemPrice', 'itemProvinceId', 'itemCityId', 'itemImage', 'showItemForm', 'selectedMenuId']);
    }

    public function deleteItem($id)
    {
        MenuItem::find($id)->delete();
    }

    public function toggleAvailability($id)
    {
        $item = MenuItem::find($id);
        $item->available = !$item->available;
        $item->save();
    }

    public function editItem($id)
    {
        $item = MenuItem::findOrFail($id);
        $this->editingItemId = $id;
        $this->itemName = $item->name;
        $this->itemDescription = $item->description;
        $this->itemPrice = $item->price;
        $this->itemProvinceId = $item->province_id;
        $this->itemCityId = $item->city_id;
        $this->selectedMenuId = $item->menu_id;
        $this->showItemForm = true;
    }

    public function updateItem()
    {
        $item = MenuItem::findOrFail($this->editingItemId);
        
        $data = [
            'name' => $this->itemName,
            'description' => $this->itemDescription,
            'price' => $this->itemPrice,
            'province_id' => $this->itemProvinceId,
            'city_id' => $this->itemCityId,
        ];

        if ($this->itemImage) {
            $data['image'] = $this->itemImage->store('menu-items', 'public');
        }

        $item->update($data);

        $this->reset(['itemName', 'itemDescription', 'itemPrice', 'itemProvinceId', 'itemCityId', 'itemImage', 'showItemForm', 'selectedMenuId', 'editingItemId']);
        $this->dispatch('notify', ['message' => 'Menu item updated!']);
    }

    public function render()
    {
        return view('livewire.restaurant-menu-management', [
            'menus' => $this->menus,
            'provinces' => \App\Models\Province::all(),
            'cities' => \App\Models\City::where('province_id', $this->itemProvinceId)->get(),
        ]);
    }
}
