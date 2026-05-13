<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Province;
use App\Models\City;
use App\Models\District;

class RegionFilter extends Component
{
    public $provinces;
    public $cities = [];

    public $selectedProvince = null;
    public $selectedCity = null;

    public function mount()
    {
        $this->provinces = Province::orderBy('name')->get();
        
        // Sync with request if present
        $this->selectedProvince = request('province');
        if ($this->selectedProvince) {
            $this->updatedSelectedProvince($this->selectedProvince);
            $this->selectedCity = request('city');
        }
    }

    public function updatedSelectedProvince($provinceId)
    {
        $this->cities = City::where('province_id', $provinceId)->orderBy('name')->get();
        $this->selectedCity = null;
    }

    public function updatedSelectedCity($cityId)
    {
        // City selected, no further region hierarchy for now
    }

    public function applyFilter()
    {
        $params = array_filter([
            'province' => $this->selectedProvince,
            'city' => $this->selectedCity,
            'search' => request('search'),
            'budget' => request('budget'),
        ]);

        return redirect()->route('explore', $params);
    }

    public function render()
    {
        return view('livewire.region-filter');
    }
}
