<div class="space-y-6">
    <div class="space-y-4">
        <p class="text-xs text-[#6F5F51] mb-2">Filter berdasarkan asal daerah masakan:</p>
        <!-- Province -->
        <div class="space-y-1.5">
            <label for="province" class="text-[10px] font-bold uppercase tracking-wider text-[#AB7B45] ml-1">Asal Provinsi</label>
            <select wire:model.live="selectedProvince" id="province" class="w-full bg-white border border-[#F0DECB] rounded-2xl px-5 py-3.5 text-sm focus:ring-2 focus:ring-[#B25C18] focus:border-transparent shadow-sm outline-none transition-all">
                <option value="">Semua Provinsi</option>
                @foreach($provinces as $province)
                    <option value="{{ $province->id }}">{{ $province->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- City -->
        <div class="space-y-1.5">
            <label for="city" class="text-[10px] font-bold uppercase tracking-wider text-[#AB7B45] ml-1">Asal Kota / Kabupaten</label>
            <select wire:model.live="selectedCity" id="city" {{ empty($cities) ? 'disabled' : '' }} class="w-full bg-white border border-[#F0DECB] rounded-2xl px-5 py-3.5 text-sm focus:ring-2 focus:ring-[#B25C18] focus:border-transparent shadow-sm outline-none transition-all disabled:opacity-50 disabled:bg-zinc-50">
                <option value="">Semua Kota</option>
                @foreach($cities as $city)
                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                @endforeach
            </select>
        </div>

    </div>

    <button wire:click="applyFilter" class="w-full rounded-2xl bg-[#B25C18] px-6 py-4 text-sm font-bold text-white shadow-lg transition hover:bg-[#8F4C11] active:scale-95">
        Terapkan Filter Wilayah
    </button>
</div>
