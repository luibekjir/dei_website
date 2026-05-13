<div class="space-y-4">
    <div class="flex items-center gap-6">
        <div class="flex items-center gap-3">
            <input type="checkbox" id="hasDelivery" wire:model="hasDelivery" class="w-5 h-5 rounded border-[#E9D6C3] text-[#B25C18] focus:ring-[#B25C18]">
            <label class="text-xs font-bold text-[#6B5A4A] uppercase tracking-wider" for="hasDelivery">Delivery</label>
        </div>

        <div class="flex items-center gap-3">
            <input type="checkbox" id="supportsPickup" wire:model="supportsPickup" class="w-5 h-5 rounded border-[#E9D6C3] text-[#B25C18] focus:ring-[#B25C18]">
            <label class="text-xs font-bold text-[#6B5A4A] uppercase tracking-wider" for="supportsPickup">Pickup</label>
        </div>

        @if($hasDelivery)
        <div class="flex items-center gap-2 pl-4 border-l border-[#F1D9C6]">
            <select id="deliveryStatus" wire:model="deliveryStatus" class="bg-[#FEF6ED] border-[#E9D6C3] rounded-full text-[10px] font-bold text-[#B25C18] uppercase tracking-widest px-4 py-1.5 focus:ring-[#B25C18] focus:border-[#B25C18]">
                <option value="available">● Available</option>
                <option value="busy">● Busy</option>
                <option value="offline">● Offline</option>
            </select>
        </div>
        @endif

        <button wire:click="save" class="bg-[#B25C18] text-white text-[10px] font-bold uppercase tracking-widest px-6 py-2 rounded-full hover:bg-[#9A4F16] transition shadow-sm">
            Save
        </button>
    </div>
</div>
