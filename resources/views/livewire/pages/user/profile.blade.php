<div class="min-h-screen bg-[#FFF8F0] -m-6">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <style>
        #address-map, #restaurant-map { 
            height: 100% !important; 
            width: 100% !important; 
            min-height: 250px;
            z-index: 10;
        }
        .leaflet-container {
            cursor: crosshair !important;
            pointer-events: auto !important;
            touch-action: none !important;
        }
    </style>
    <div class="flex flex-col lg:flex-row">
        <aside class="w-full lg:w-64 bg-zinc-100 shadow-sm lg:min-h-screen">
            <div class="p-4 overflow-x-auto lg:overflow-visible">
                <nav class="flex lg:flex-col gap-2 min-w-max lg:min-w-0">
                    <button 
                        wire:click="setTab('dashboard')"
                        class="flex-1 lg:w-full text-left px-4 py-3 rounded-xl transition {{ $activeTab === 'dashboard' ? 'bg-[#B25C18] text-white font-bold shadow-lg shadow-orange-900/20' : 'text-zinc-700 hover:bg-zinc-200' }}"
                    >
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            <span class="whitespace-nowrap">Dashboard</span>
                        </div>
                    </button>


                    <button 
                        wire:click="setTab('orders')"
                        class="flex-1 lg:w-full text-left px-4 py-3 rounded-xl transition {{ $activeTab === 'orders' ? 'bg-[#B25C18] text-white font-bold shadow-lg shadow-orange-900/20' : 'text-zinc-700 hover:bg-zinc-200' }}"
                    >
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                            <span class="whitespace-nowrap">Orders</span>
                        </div>
                    </button>

                    <button 
                        wire:click="setTab('settings')"
                        class="flex-1 lg:w-full text-left px-4 py-3 rounded-xl transition {{ $activeTab === 'settings' ? 'bg-[#B25C18] text-white font-bold shadow-lg shadow-orange-900/20' : 'text-zinc-700 hover:bg-zinc-200' }}"
                    >
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span class="whitespace-nowrap">Settings</span>
                        </div>
                    </button>

                    <button 
                        wire:click="setTab('business')"
                        class="flex-1 lg:w-full text-left px-4 py-3 rounded-xl transition {{ $activeTab === 'business' ? 'bg-[#B25C18] text-white font-bold shadow-lg shadow-orange-900/20' : 'text-zinc-700 hover:bg-zinc-200' }}"
                    >
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                            <span class="whitespace-nowrap">My Business</span>
                        </div>
                    </button>
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-4 lg:p-12 min-w-0">
            @if($activeTab === 'dashboard')
                <!-- Dashboard Content -->
                <div class="mb-10">
                    <h1 class="text-3xl lg:text-5xl font-black text-[#1D1D1B] tracking-tight mb-2">Kitchen Analytics</h1>
                    <p class="text-zinc-500 text-lg">Review your culinary investment and taste</p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Weekly Spending -->
                    <div class="lg:col-span-2 bg-white rounded-[2.5rem] border border-zinc-100 shadow-sm p-8 flex flex-col">
                        <h3 class="text-xs font-bold uppercase tracking-widest text-[#AB7B45] mb-6">Weekly Spending</h3>
                        <div class="mb-10">
                            <span class="text-5xl font-black text-[#1D1D1B]">@currency($weeklySpending)</span>
                            <p class="text-zinc-400 text-sm mt-1">Total investment in the last 7 days</p>
                        </div>
                        <div class="relative h-64 flex-1 bg-zinc-50 rounded-[2rem] flex items-center justify-center border border-dashed border-zinc-200 overflow-hidden group">
                            <p class="text-zinc-400 text-sm font-bold uppercase tracking-widest group-hover:scale-110 transition-transform">Spending trend</p>
                            <div class="absolute inset-x-0 bottom-0 h-1/2 bg-gradient-to-t from-orange-500/10 to-transparent"></div>
                        </div>
                    </div>

                    <!-- Personal Info -->
                    <div class="bg-[#B25C18] rounded-[2.5rem] p-10 text-white shadow-xl shadow-orange-900/20 relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16 blur-2xl"></div>
                        <div class="flex flex-col items-center text-center relative z-10">
                            <div class="w-24 h-24 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center text-white text-4xl font-black mb-6 shadow-xl border border-white/30">
                                {{ auth()->user()->initials() }}
                            </div>
                            <h2 class="text-2xl font-black mb-1">{{ $name }}</h2>
                            <p class="text-orange-200 text-sm opacity-80">{{ $email }}</p>
                        </div>
                    </div>
                </div>

                <!-- Saved Addresses -->
                <div class="mt-16">
                    <div class="flex items-center justify-between mb-8">
                        <h2 class="text-3xl font-black text-[#1D1D1B] tracking-tight">Saved Addresses</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($savedAddresses as $address)
                        <div class="bg-white rounded-3xl p-6 border border-zinc-100 shadow-sm hover:shadow-md transition-all">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-10 h-10 rounded-xl bg-orange-50 flex items-center justify-center text-lg">📍</div>
                                <h3 class="text-lg font-bold text-zinc-800">{{ $address->label }}</h3>
                            </div>
                            <p class="text-sm text-zinc-500 leading-relaxed">{{ $address->address_line }}, {{ $address->city }}</p>
                        </div>
                        @empty
                        <div class="col-span-full bg-zinc-50 rounded-[2rem] p-12 text-center border-2 border-dashed border-zinc-200">
                            <p class="text-zinc-400 font-bold uppercase tracking-widest">No saved addresses yet.</p>
                        </div>
                        @endforelse

                        <div wire:click="$set('showAddressModal', true); $dispatch('open-address-modal')" class="bg-white rounded-3xl border-4 border-dashed border-zinc-100 p-8 flex flex-col items-center justify-center cursor-pointer hover:border-[#B25C18] hover:bg-orange-50/30 transition-all group">
                            <span class="text-3xl mb-2 group-hover:scale-125 transition-transform">➕</span>
                            <p class="text-[#B25C18] font-black text-xs uppercase tracking-widest">Add New Address</p>
                        </div>
                    </div>
                </div>

                <!-- Activity History -->
                <div class="mt-16">
                    <h2 class="text-3xl font-black text-[#1D1D1B] tracking-tight mb-8">Activity History</h2>
                    <div class="space-y-4">
                        @forelse($recentOrders as $order)
                        <div class="bg-white rounded-3xl p-6 border border-zinc-100 shadow-sm flex flex-col sm:flex-row items-center gap-6 hover:shadow-md transition-all">
                            <div class="w-16 h-16 rounded-2xl bg-[#F4E6D9] flex items-center justify-center text-[#AB7B45] font-black text-2xl shrink-0 shadow-inner">
                                {{ $order->restaurant->name[0] }}
                            </div>
                            <div class="flex-1 text-center sm:text-left">
                                <h3 class="text-xl font-bold text-zinc-800">{{ $order->restaurant->name }}</h3>
                                <div class="flex items-center justify-center sm:justify-start gap-2 mt-1">
                                    <span class="text-[10px] bg-green-50 text-green-600 px-2 py-1 rounded-full font-bold uppercase tracking-tighter">Completed</span>
                                    <p class="text-xs text-zinc-400 font-medium">{{ $order->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <a href="#" class="w-full sm:w-auto px-6 py-3 bg-zinc-50 rounded-xl text-xs font-bold text-zinc-600 hover:bg-zinc-100 transition">View Details</a>
                        </div>
                        @empty
                        <div class="bg-zinc-50 rounded-[2rem] p-12 text-center border-2 border-dashed border-zinc-200">
                            <p class="text-zinc-400 font-bold uppercase tracking-widest">No activity history found.</p>
                        </div>
                        @endforelse
                    </div>
                </div>

            @elseif($activeTab === 'orders')
                @include('pages.user.orders_user')
            @elseif($activeTab === 'settings')
                <div class="bg-white rounded-[2.5rem] shadow-sm p-10 border border-zinc-200">
                    <h2 class="text-3xl font-bold text-zinc-800 mb-2">Account Settings</h2>
                    <form wire:submit="saveProfile" class="space-y-8 mt-10">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-3">
                                <label class="text-xs font-bold uppercase tracking-widest text-zinc-500">Full Name</label>
                                <input type="text" wire:model="name" class="w-full bg-zinc-50 border-zinc-200 rounded-2xl py-4 px-6 focus:ring-orange-500 transition">
                            </div>
                            <div class="space-y-3">
                                <label class="text-xs font-bold uppercase tracking-widest text-zinc-500">Email Address</label>
                                <input type="email" wire:model="email" disabled class="w-full bg-zinc-100 border-zinc-200 rounded-2xl py-4 px-6 text-zinc-400 cursor-not-allowed">
                            </div>
                        </div>
                        
                        <div class="space-y-4">
                            <label class="text-xs font-bold uppercase tracking-widest text-zinc-500">Profile Picture</label>
                            <div class="flex items-center gap-8">
                                <div class="w-24 h-24 rounded-full bg-zinc-100 border-2 border-zinc-200 overflow-hidden flex items-center justify-center relative group">
                                    @if($avatar)
                                        <img src="{{ $avatar->temporaryUrl() }}" class="w-full h-full object-cover">
                                    @elseif(auth()->user()->profile_photo_path)
                                        <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" class="w-full h-full object-cover">
                                    @else
                                        <span class="text-3xl text-zinc-300 font-bold">{{ substr(auth()->user()->name, 0, 1) }}</span>
                                    @endif
                                    <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                        <label class="cursor-pointer">
                                            <input type="file" wire:model="avatar" class="hidden">
                                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        </label>
                                    </div>
                                </div>
                                <div class="space-y-1">
                                    <p class="text-sm font-bold text-zinc-700">Change Avatar</p>
                                    <p class="text-[10px] text-zinc-400">JPG, PNG or WEBP. Max 2MB.</p>
                                    <div wire:loading wire:target="avatar" class="text-[10px] text-orange-500 font-bold animate-pulse">Uploading...</div>
                                </div>
                            </div>
                        </div>
                        
                        <button type="submit" class="bg-orange-500 text-white px-10 py-4 rounded-full font-bold">Save Profile Changes</button>
                    </form>
                </div>

            @elseif($activeTab === 'business')
                <div class="space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-4xl font-bold text-zinc-800">My Business</h1>
                            <p class="text-zinc-500 mt-2">Manage your culinary investments and restaurants</p>
                        </div>
                        <button wire:click="$set('showRestaurantModal', true); $dispatch('open-restaurant-modal')" class="bg-[#B25C18] text-white px-8 py-4 rounded-2xl font-bold shadow-lg shadow-orange-900/20 hover:scale-105 transition-all">
                            Add New Restaurant
                        </button>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @forelse($userRestaurants as $restaurant)
                        <div class="bg-white rounded-[2.5rem] border border-zinc-100 shadow-sm overflow-hidden group hover:shadow-xl transition-all duration-500">
                            <div class="h-48 overflow-hidden relative">
                                <img src="{{ $restaurant->image ?? 'https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?q=80&w=2070&auto=format&fit=crop' }}" alt="{{ $restaurant->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            </div>
                            <div class="p-8">
                                <h3 class="text-xl font-bold text-zinc-800 mb-4">{{ $restaurant->name }}</h3>
                                <p class="text-sm text-zinc-500 line-clamp-2 mb-6">{{ $restaurant->description }}</p>
                                <a href="/restaurant/{{ $restaurant->id }}/manage" class="block w-full bg-zinc-900 text-white py-4 rounded-2xl text-center font-bold">Manage Restaurant</a>
                            </div>
                        </div>
                        @empty
                        <div class="col-span-3 bg-white rounded-[3rem] border-4 border-dashed border-zinc-100 p-20 text-center">
                            <h2 class="text-2xl font-bold text-zinc-800 mb-2">No Business Registered</h2>
                            <p class="text-zinc-500 mb-8 max-w-sm mx-auto">Start your business journey with Culinary Atelier today.</p>
                            <button wire:click="$set('showRestaurantModal', true); $dispatch('open-restaurant-modal')" class="bg-[#B25C18] text-white px-10 py-4 rounded-2xl font-bold">
                                Open Your Kitchen
                            </button>
                        </div>
                        @endforelse
                    </div>
                </div>
            @endif
        </main>
    </div>

    <!-- Modals Section (Always Available) -->
    
    <!-- Address Modal -->
    @if($showAddressModal)
    <div class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[100] flex items-center justify-center p-4">
        <div class="bg-white rounded-[3rem] w-full max-w-4xl overflow-hidden shadow-2xl">
            <div class="flex flex-col md:flex-row h-[90vh] md:h-[80vh]">
                <div class="w-full md:w-1/2 h-64 md:h-auto relative bg-zinc-100">
                    <div id="address-map" class="h-full w-full" wire:ignore></div>
                </div>
                <div class="w-full md:w-1/2 p-6 md:p-10 overflow-y-auto">
                    <div class="flex justify-between items-center mb-8">
                        <h2 class="text-2xl md:text-3xl font-black text-[#1D1D1B] tracking-tight">New Address</h2>
                        <button wire:click="$set('showAddressModal', false)" class="p-2 rounded-xl hover:bg-zinc-100 transition-colors">
                            <svg class="w-6 h-6 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                    <form wire:submit.prevent="addAddress" class="space-y-6">
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold uppercase tracking-widest text-zinc-400 ml-1">Address Label</label>
                            <input type="text" wire:model="address_label" placeholder="e.g. Home, Office" class="w-full bg-zinc-50 border-zinc-100 rounded-2xl py-4 px-6 focus:ring-2 focus:ring-[#B25C18] outline-none">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold uppercase tracking-widest text-zinc-400 ml-1">Full Address</label>
                            <textarea wire:model="address_line" class="w-full bg-zinc-50 border-zinc-100 rounded-2xl py-4 px-6 focus:ring-2 focus:ring-[#B25C18] outline-none" rows="4" placeholder="Pin on map or type here..."></textarea>
                        </div>
                        <button type="submit" class="w-full bg-[#B25C18] text-white py-5 rounded-2xl font-black uppercase tracking-[0.2em] shadow-2xl hover:scale-[1.02] active:scale-95 transition-all">Save Address</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Restaurant Modal -->
    @if($showRestaurantModal)
    <div class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[100] flex items-center justify-center p-4">
        <div class="bg-white rounded-[3rem] w-full max-w-5xl overflow-hidden shadow-2xl animate-in fade-in zoom-in duration-300">
            <div class="flex flex-col md:flex-row h-[85vh]">
                <!-- Map Side -->
                <div class="w-full md:w-5/12 relative bg-zinc-100 border-r border-zinc-100">
                    <div id="restaurant-map" class="h-full w-full" wire:ignore></div>
                </div>

                <!-- Form Side -->
                <div class="w-full md:w-7/12 p-12 overflow-y-auto bg-white">
                    <div class="flex justify-between items-center mb-10">
                        <div>
                            <h2 class="text-3xl font-black text-[#1D1D1B] tracking-tight">Open Your Kitchen</h2>
                            <p class="text-zinc-500 mt-1">Lengkapi data untuk mendaftarkan bisnis Anda.</p>
                        </div>
                        <button wire:click="$set('showRestaurantModal', false)" class="p-2 rounded-xl hover:bg-zinc-100 transition-colors">
                            <svg class="w-8 h-8 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                    <form wire:submit.prevent="addRestaurant" class="space-y-8">
                        <div class="grid grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-[10px] font-bold uppercase tracking-widest text-zinc-400 ml-1">Nama Bisnis</label>
                                <input type="text" wire:model="res_name" placeholder="Nama Bisnis" class="w-full bg-zinc-50 border-zinc-100 rounded-2xl py-4 px-6">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-bold uppercase tracking-widest text-zinc-400 ml-1">Kategori</label>
                                <select wire:model="res_category_id" class="w-full bg-zinc-50 border-zinc-100 rounded-2xl py-4 px-6">
                                    <option value="">Pilih Kategori</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold uppercase tracking-widest text-zinc-400 ml-1">Deskripsi</label>
                            <textarea wire:model="res_description" class="w-full bg-zinc-50 border-zinc-100 rounded-2xl py-4 px-6" rows="3"></textarea>
                        </div>
                        <div class="grid grid-cols-2 gap-6">
                            <select wire:model.live="res_province_id" class="w-full bg-zinc-50 border-zinc-100 rounded-2xl py-4 px-6">
                                <option value="">Provinsi</option>
                                @foreach($provinces as $province)
                                    <option value="{{ $province->id }}">{{ $province->name }}</option>
                                @endforeach
                            </select>
                            <select wire:model="res_city_id" class="w-full bg-zinc-50 border-zinc-100 rounded-2xl py-4 px-6">
                                <option value="">Kota</option>
                                @foreach($resCities as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <textarea wire:model="res_address" class="w-full bg-zinc-50 border-zinc-100 rounded-2xl py-4 px-6" placeholder="Alamat Lengkap"></textarea>
                        
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold uppercase tracking-widest text-zinc-400 ml-1">Foto Restoran</label>
                            <div class="relative group h-48 w-full bg-zinc-50 border-2 border-dashed border-zinc-200 rounded-[2rem] overflow-hidden flex items-center justify-center transition-all hover:bg-zinc-100">
                                @if($res_image)
                                    <img src="{{ $res_image->temporaryUrl() }}" class="w-full h-full object-cover">
                                @else
                                    <div class="text-center space-y-2">
                                        <svg class="w-10 h-10 text-zinc-300 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        <p class="text-xs font-bold text-zinc-400">Click to upload brand photo</p>
                                    </div>
                                @endif
                                <input type="file" wire:model="res_image" class="absolute inset-0 opacity-0 cursor-pointer">
                                <div wire:loading wire:target="res_image" class="absolute inset-0 bg-white/60 flex items-center justify-center">
                                    <span class="text-xs font-bold text-orange-500 animate-pulse">Uploading...</span>
                                </div>
                            </div>
                        </div>
                        
                        <button type="submit" class="w-full bg-[#B25C18] text-white py-6 rounded-2xl font-black uppercase tracking-[0.2em] shadow-2xl">Buka Dapur Sekarang</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif

    <script>
        function initAddressMap() {
            const mapContainer = document.getElementById('address-map');
            if (!mapContainer || mapContainer._leaflet_id) return;
            
            const map = L.map('address-map', {
                tap: false, // Prevents conflicts with mobile touch events in modals
                touchZoom: true
            }).setView([-7.2575, 112.7521], 13);
            
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);
            
            let marker;
            map.on('click', function(e) {
                const { lat, lng } = e.latlng;
                if (marker) marker.setLatLng(e.latlng); else marker = L.marker(e.latlng).addTo(map);
                @this.set('latitude', lat); @this.set('longitude', lng);
                fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`)
                    .then(r => r.json()).then(d => {
                        @this.set('address_line', d.display_name);
                    });
            });

            // Crucial for mobile/modal layouts
            setTimeout(() => {
                map.invalidateSize();
            }, 500);
        }

        function initRestaurantMap() {
            const mapContainer = document.getElementById('restaurant-map');
            if (!mapContainer || mapContainer._leaflet_id) return;
            
            const map = L.map('restaurant-map', {
                tap: false,
                touchZoom: true
            }).setView([-7.2575, 112.7521], 13);
            
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);
            
            let marker;
            map.on('click', function(e) {
                const { lat, lng } = e.latlng;
                if (marker) marker.setLatLng(e.latlng); else marker = L.marker(e.latlng).addTo(map);
                @this.set('res_latitude', lat); @this.set('res_longitude', lng);
                fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`)
                    .then(r => r.json()).then(d => { @this.set('res_address', d.display_name); });
            });
            
            setTimeout(() => {
                map.invalidateSize();
            }, 500);
        }

        window.addEventListener('open-restaurant-modal', () => setTimeout(initRestaurantMap, 200));
        window.addEventListener('open-address-modal', () => setTimeout(initAddressMap, 200));
        
        document.addEventListener('livewire:navigated', () => {
            if (document.getElementById('address-map')) initAddressMap();
            if (document.getElementById('restaurant-map')) initRestaurantMap();
        });
    </script>
</div>
