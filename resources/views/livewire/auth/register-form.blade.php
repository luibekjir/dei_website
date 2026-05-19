<div class="flex flex-col gap-6 text-black dark:text-black">
    
    <x-auth-header 
        :title="__('Create an account')" 
        :description="__('Complete your details to start exploring and ordering.')" 
    />

    <form wire:submit="register" class="flex flex-col gap-6 text-black">

        <!-- Name -->
        <flux:input
            wire:model="name"
            label="Full Name"
            label:class="!text-black !opacity-100"
            class="!text-black"
            type="text"
            required
            autofocus
            placeholder="e.g. John Doe"
            class="!border-2 !border-black !bg-white !opacity-100 accent-[#B25C18]"
        />

        <!-- Email Address -->
        <flux:input
            wire:model="email"
            label="Email Address"
            label:class="!text-black !opacity-100"
            class="!text-black"
            type="email"
            required
            placeholder="email@example.com"
            class="!border-2 !border-black !bg-white !opacity-100 accent-[#B25C18]"
        />

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <!-- Password -->
            <flux:input
                wire:model="password"
                label="Password"
                label:class="!text-black !opacity-100"
                class="!text-black"
                type="password"
                required
                viewable
                class="!border-2 !border-black !bg-white !opacity-100 accent-[#B25C18]"
            />

            <!-- Confirm Password -->
            <flux:input
                wire:model="password_confirmation"
                label="Confirm Password"
                label:class="!text-black !opacity-100"
                class="!text-black"
                type="password"
                required
                viewable
                class="!border-2 !border-black !bg-white !opacity-100 accent-[#B25C18]"
            />

        </div>

        <div class="pt-4 border-t border-zinc-200">

            <h3 class="text-sm font-bold !text-black mb-4 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-[#B25C18]">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                </svg>
                Informasi Pengiriman
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">

                <!-- Province -->
                <div class="space-y-1.5">
                    <label class="text-sm font-medium !text-black">Provinsi</label>

                    <select 
                        wire:model.live="province_id" 
                        class="w-full bg-white border border-zinc-300 rounded-lg px-3 py-2 text-sm text-black focus:ring-2 focus:ring-[#B25C18] outline-none"
                    >
                        <option value="">Pilih Provinsi</option>

                        @foreach($provinces as $province)
                            <option value="{{ $province->id }}">
                                {{ $province->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('province_id') 
                        <span class="text-xs text-red-500">{{ $message }}</span> 
                    @enderror
                </div>

                <!-- City -->
                <div class="space-y-1.5">
                    <label class="text-sm font-medium !text-black">
                        Kota / Kabupaten
                    </label>

                    <select 
                        wire:model="city_id"
                        {{ empty($cities) ? 'disabled' : '' }}
                        class="w-full bg-white border border-zinc-300 rounded-lg px-3 py-2 text-sm text-black focus:ring-2 focus:ring-[#B25C18] outline-none disabled:opacity-50"
                    >
                        <option value="">Pilih Kota</option>

                        @foreach($cities as $city)
                            <option value="{{ $city->id }}">
                                {{ $city->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('city_id') 
                        <span class="text-xs text-red-500">{{ $message }}</span> 
                    @enderror
                </div>

            </div>

            <!-- Interactive Map Picker -->
            <div class="mt-4 space-y-2">

                <label class="text-sm font-medium !text-black flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-[#B25C18]">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 6.75V15m6-10.5v.15m0 4.5v.15m0 4.5v.15m0 4.5V15m-6-10.5v.15m0 4.5v.15m0 4.5v.15m0 4.5V15m-10.5-3h21" />
                    </svg>

                    Pilih Titik Lokasi di Peta
                </label>

                <div 
                    id="register-map" 
                    wire:ignore 
                    class="h-64 w-full rounded-2xl border-2 border-[#F0DECB] shadow-inner overflow-hidden z-0"
                ></div>

                <p class="text-[10px] text-[#AB7B45] italic">
                    Klik pada peta untuk menandai lokasi pengiriman Anda.
                </p>

                <input type="hidden" wire:model="latitude" id="lat-input">
                <input type="hidden" wire:model="longitude" id="lng-input">

            </div>

            <!-- Address Line -->
            <div class="mt-6">
                <flux:textarea
                    wire:model="address_line"
                    label="Alamat Lengkap"
                    label:class="!text-black !opacity-100"
                    class="!text-black"
                    placeholder="Jl. Nama Jalan No. XX, Kelurahan..."
                    required
                    class="!border-2 !border-black !bg-white !opacity-100 accent-[#B25C18]"
                />
            </div>

            <!-- Postal Code -->
            <div class="mt-4">
                <flux:input
                    wire:model="postal_code"
                    label="Kode Pos"
                    label:class="!text-black !opacity-100"
                    class="!text-black"
                    type="text"
                    placeholder="e.g. 60213"
                    class="!border-2 !border-black !bg-white !opacity-100 accent-[#B25C18]"
                />
            </div>

        </div>

       <div class="flex items-center justify-end mt-4">
    
    <flux:button 
        type="submit"
        class="w-full !bg-[#B25C18] hover:!bg-[#8F4C11] !text-white !border-none py-6 font-bold !opacity-100"
    >
        Daftar Sekarang
    </flux:button>

</div>

    </form>

    @script
    <script>
        const initialLat = $wire.latitude || -7.2858;
        const initialLng = $wire.longitude || 112.6313;

        const map = L.map('register-map').setView([initialLat, initialLng], 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        let marker = L.marker([initialLat, initialLng], {
            draggable: true
        }).addTo(map);

        async function reverseGeocode(lat, lng) {
            try {
                const response = await fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`);
                const data = await response.json();
                
                if (data) {
                    $wire.call('updateAddressFromMap', {
                        lat: lat,
                        lng: lng,
                        display_name: data.display_name,
                        address: data.address
                    });
                }
            } catch (error) {
                console.error('Reverse geocoding failed:', error);

                $wire.latitude = lat;
                $wire.longitude = lng;
            }
        }

        map.on('click', function(e) {
            const { lat, lng } = e.latlng;

            marker.setLatLng([lat, lng]);

            reverseGeocode(lat, lng);
        });

        marker.on('dragend', function(e) {
            const { lat, lng } = marker.getLatLng();

            reverseGeocode(lat, lng);
        });

        setTimeout(() => {
            map.invalidateSize();
        }, 500);
    </script>
    @endscript

</div>