<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Models\Province;
use App\Models\City;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;

class RegisterForm extends Component
{
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    
    public $province_id;
    public $city_id;
    public $address_line;
    public $postal_code;
    public $latitude = -7.2858; // Default near UC
    public $longitude = 112.6313;

    public function updatedProvinceId()
    {
        $this->city_id = null;
    }

    public function updateAddressFromMap($details)
    {
        $this->latitude = $details['lat'];
        $this->longitude = $details['lng'];
        
        if (isset($details['address'])) {
            $addr = $details['address'];
            
            // Try to match Province
            if (isset($addr['state'])) {
                $province = Province::where('name', 'like', '%' . $addr['state'] . '%')->first();
                if ($province) {
                    $this->province_id = $province->id;
                    
                    // Try to match City
                    $cityName = $addr['city'] ?? $addr['town'] ?? $addr['village'] ?? $addr['county'] ?? null;
                    if ($cityName) {
                        $city = City::where('province_id', $this->province_id)
                            ->where('name', 'like', '%' . $cityName . '%')
                            ->first();
                        if ($city) {
                            $this->city_id = $city->id;
                        }
                    }
                }
            }

            // Fill address line
            $this->address_line = $details['display_name'] ?? $this->address_line;
            $this->postal_code = $addr['postcode'] ?? $this->postal_code;
        }
    }

    public function register()
    {
        $this->email = strtolower($this->email);

        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'province_id' => ['required', 'exists:provinces,id'],
            'city_id' => ['required', 'exists:cities,id'],
            'address_line' => ['required', 'string', 'max:500'],
            'postal_code' => ['nullable', 'string', 'max:10'],
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'province_id' => $this->province_id,
            'city_id' => $this->city_id,
            'profile_completed' => true,
        ]);

        $user->addresses()->create([
            'label' => 'Utama',
            'address_line' => $this->address_line,
            'city' => City::find($this->city_id)->name ?? '',
            'state' => Province::find($this->province_id)->name ?? '',
            'postal_code' => $this->postal_code,
            'is_primary' => true,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ]);

        Auth::login($user);

        return redirect()->route('explore');
    }

    public function render()
    {
        return view('livewire.auth.register-form', [
            'provinces' => Province::orderBy('name')->get(),
            'cities' => $this->province_id ? City::where('province_id', $this->province_id)->orderBy('name')->get() : [],
        ]);
    }
}
