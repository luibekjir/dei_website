<div>
    <div class="space-y-6">
        <!-- Add Dish Button -->
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold text-[#1D1D1B]">Menu Management</h3>
            <button wire:click="$set('showItemForm', true)" 
                class="bg-[#B25C18] text-white px-8 py-3 rounded-full font-bold shadow-lg shadow-orange-900/20 hover:scale-105 transition-all flex items-center gap-2">
                <span class="text-xl">+</span> Add New Dish
            </button>
        </div>

        <!-- Menus List Grouped by Heritage -->
        <div class="grid gap-6">
            @forelse($menus as $menu)
                <div class="bg-white rounded-[2rem] overflow-hidden shadow-sm border border-[#F0DECB]">
                    <div class="bg-[#FFF7F0] px-8 py-5 flex items-center justify-between border-b border-[#F0DECB]">
                        <div class="flex items-center gap-3">
                            <span class="text-2xl">🏛️</span>
                            <h4 class="font-bold text-[#6D3C0F] text-lg">{{ $menu->name }} Heritage</h4>
                        </div>
                        <button wire:click="deleteMenu({{ $menu->id }})" 
                            onclick="confirm('Delete this heritage category and all items?') || event.stopImmediatePropagation()"
                            class="text-xs font-bold text-red-400 hover:text-red-600 uppercase tracking-widest">
                            Delete Group
                        </button>
                    </div>

                    <div class="p-6 space-y-4">
                        @forelse($menu->items as $item)
                            <div class="flex items-center justify-between p-4 rounded-3xl bg-[#FEF9F5] border border-[#F5E6D3] hover:border-orange-200 transition-colors">
                                <div class="flex items-center gap-5">
                                    <div class="h-14 w-14 rounded-2xl bg-white border border-orange-100 flex items-center justify-center text-2xl shadow-sm overflow-hidden">
                                        @if($item->image)
                                            <img src="{{ asset('storage/' . $item->image) }}" class="w-full h-full object-cover">
                                        @else
                                            🥘
                                        @endif
                                    </div>
                                    <div>
                                        <p class="font-bold text-[#1D1D1B]">{{ $item->name }}</p>
                                        <p class="text-xs text-[#6B5A4A] font-medium mt-0.5">@currency($item->price)</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4">
                                    <button wire:click="toggleAvailability({{ $item->id }})" 
                                        class="text-[10px] px-4 py-1.5 rounded-full font-bold uppercase tracking-widest {{ $item->available ? 'bg-green-50 text-green-700 border border-green-100' : 'bg-zinc-50 text-zinc-400 border border-zinc-100' }}">
                                        {{ $item->available ? 'Available' : 'Sold Out' }}
                                    </button>
                                    <button wire:click="editItem({{ $item->id }})" class="text-zinc-300 hover:text-orange-500 transition-colors">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </button>
                                    <button wire:click="deleteItem({{ $item->id }})" class="text-zinc-300 hover:text-red-500 transition-colors">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </div>
                        @empty
                            <p class="text-center py-6 text-sm text-zinc-400 italic">No dishes in this heritage category.</p>
                        @endforelse
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-[2rem] p-16 text-center border-4 border-dashed border-zinc-100">
                    <div class="text-5xl mb-6">👨‍🍳</div>
                    <h4 class="text-xl font-bold text-zinc-800 mb-2">No menu yet</h4>
                    <p class="text-zinc-500 mb-8">Start adding your signature heritage dishes to attract customers!</p>
                    <button wire:click="$set('showItemForm', true)" class="bg-[#B25C18] text-white px-10 py-4 rounded-full font-bold shadow-lg shadow-orange-900/20">Add Your First Dish</button>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Modal for Adding Item -->
    @if($showItemForm)
        <div class="fixed inset-0 z-[100] flex items-center justify-center bg-black/60 backdrop-blur-sm p-4">
            <div class="bg-white rounded-[2.5rem] w-full max-w-xl max-h-[90vh] overflow-y-auto shadow-2xl animate-in fade-in zoom-in duration-300">
                <div class="p-6 md:p-10">
                    <div class="flex justify-between items-center mb-8">
                        <div>
                            <h3 class="text-2xl md:text-3xl font-black text-[#1D1D1B] tracking-tight">{{ $editingItemId ? 'Edit Dish' : 'Add New Dish' }}</h3>
                            <p class="text-xs md:text-sm text-zinc-500 mt-1">Specify the culinary heritage of your menu</p>
                        </div>
                        <button wire:click="$set('showItemForm', false)" class="p-2 rounded-xl hover:bg-zinc-100 transition-colors">
                            <svg class="w-6 h-6 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>

                    <div class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                            <div class="space-y-2">
                                <label class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest ml-1">Province Origin</label>
                                <select wire:model.live="itemProvinceId" class="w-full bg-zinc-50 border-zinc-100 rounded-2xl py-4 px-6 focus:ring-2 focus:ring-[#B25C18] outline-none text-sm transition-all">
                                    <option value="">Select Province</option>
                                    @foreach($provinces as $province)
                                        <option value="{{ $province->id }}">{{ $province->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest ml-1">City Heritage</label>
                                <select wire:model="itemCityId" @disabled(!$itemProvinceId) class="w-full bg-zinc-50 border-zinc-100 rounded-2xl py-4 px-6 focus:ring-2 focus:ring-[#B25C18] outline-none text-sm disabled:opacity-50 transition-all">
                                    <option value="">Select City (e.g. Padang, Solo)</option>
                                    @foreach($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest ml-1">Dish Name</label>
                            <input type="text" wire:model.defer="itemName" placeholder="e.g. Rendang Daging, Gudeg" class="w-full bg-zinc-50 border-zinc-100 rounded-2xl py-4 px-6 focus:ring-2 focus:ring-[#B25C18] outline-none text-sm transition-all">
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest ml-1">Description</label>
                            <textarea wire:model.defer="itemDescription" rows="3" placeholder="Tell customers what makes it special..." class="w-full bg-zinc-50 border-zinc-100 rounded-2xl py-4 px-6 focus:ring-2 focus:ring-[#B25C18] outline-none text-sm transition-all"></textarea>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest ml-1">Price (IDR)</label>
                            <input type="number" wire:model.defer="itemPrice" placeholder="0" class="w-full bg-zinc-50 border-zinc-100 rounded-2xl py-4 px-6 focus:ring-2 focus:ring-[#B25C18] outline-none text-sm transition-all">
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest ml-1">Foto Masakan</label>
                            <div class="relative group h-40 w-full bg-zinc-50 border-2 border-dashed border-zinc-200 rounded-3xl overflow-hidden flex items-center justify-center transition-all hover:bg-zinc-100">
                                @if($itemImage)
                                    <img src="{{ $itemImage->temporaryUrl() }}" class="w-full h-full object-cover">
                                @else
                                    <div class="text-center space-y-2">
                                        <svg class="w-10 h-10 text-zinc-300 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        <p class="text-[10px] font-bold text-zinc-400">Click to upload brand photo</p>
                                    </div>
                                @endif
                                <input type="file" wire:model="itemImage" class="absolute inset-0 opacity-0 cursor-pointer">
                                <div wire:loading wire:target="itemImage" class="absolute inset-0 bg-white/60 flex items-center justify-center">
                                    <span class="text-xs font-bold text-orange-500 animate-pulse">Uploading...</span>
                                </div>
                            </div>
                        </div>

                        <button wire:click="{{ $editingItemId ? 'updateItem' : 'addItem' }}" class="w-full bg-[#B25C18] text-white py-6 rounded-2xl font-black uppercase tracking-[0.2em] shadow-2xl shadow-orange-900/20 hover:scale-[1.02] active:scale-95 transition-all mt-4">
                            {{ $editingItemId ? 'Save Changes' : 'Add to Menu' }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
