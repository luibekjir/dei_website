<div wire:poll.5s class="mb-8">
    <h1 class="text-4xl font-bold text-zinc-800 mb-2">Order Tracking</h1>
    <p class="text-zinc-600 text-lg">Keeping an eye on your culinary desire</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2 space-y-8">
        <!-- Active Order Tracking -->
        @php $activeOrder = $allOrders->whereIn('status', ['pending', 'preparing', 'on_delivery'])->first(); @endphp
        
        @if($activeOrder)
        <div class="bg-white rounded-3xl shadow-sm border border-zinc-100 p-8">
            <div class="flex items-start gap-6 mb-8">
                <div class="w-24 h-24 rounded-2xl bg-orange-50 flex items-center justify-center text-orange-500 font-bold text-3xl">
                    {{ $activeOrder->restaurant->name[0] }}
                </div>
                <div class="flex-1">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-2xl font-bold text-zinc-800 mb-1">{{ $activeOrder->restaurant->name }}</h3>
                            <div class="flex items-center gap-4 text-sm text-zinc-500">
                                <span class="font-mono">Order #{{ str_pad($activeOrder->id, 5, '0', STR_PAD_LEFT) }}</span>
                                <span class="text-orange-500 font-bold">•</span>
                                <span class="text-orange-500 font-bold">Arriving soon</span>
                            </div>
                        </div>
                        <span class="bg-orange-500 text-white px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest">{{ $activeOrder->status }}</span>
                    </div>
                </div>
            </div>

            <div class="mb-10 px-4">
                <h4 class="text-xs font-bold text-zinc-400 uppercase tracking-widest mb-6">Delivery Progress</h4>
                <div class="flex items-center justify-between relative">
                    <div class="absolute top-6 left-0 right-0 h-1 bg-zinc-100 rounded-full"></div>
                    <div class="absolute top-6 left-0 h-1 bg-orange-500 rounded-full transition-all duration-1000" 
                         style="width: {{ $activeOrder->status === 'pending' ? '10%' : ($activeOrder->status === 'preparing' ? '50%' : '90%') }};"></div>

                    @foreach(['pending' => 'Ordered', 'preparing' => 'Preparing', 'on_delivery' => 'Delivery'] as $status => $label)
                    <div class="flex flex-col items-center relative z-10">
                        <div class="w-12 h-12 {{ $activeOrder->status === $status || ($status === 'pending' && $activeOrder->status !== 'pending') ? 'bg-orange-500 border-4 border-orange-100' : 'bg-white border-4 border-zinc-50' }} rounded-full flex items-center justify-center mb-3 transition-colors">
                            <svg class="w-5 h-5 {{ $activeOrder->status === $status || ($status === 'pending' && $activeOrder->status !== 'pending') ? 'text-white' : 'text-zinc-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                @if($status === 'pending') <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/> @endif
                                @if($status === 'preparing') <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/> @endif
                                @if($status === 'on_delivery') <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/> @endif
                            </svg>
                        </div>
                        <span class="text-[10px] font-bold uppercase tracking-widest {{ $activeOrder->status === $status ? 'text-orange-600' : 'text-zinc-400' }}">{{ $label }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-zinc-50 rounded-2xl p-4 flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-white border border-zinc-200 flex items-center justify-center">
                    🚚
                </div>
                <div class="flex-1">
                    <p class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest">Courier assigned</p>
                    <h4 class="text-sm font-bold text-zinc-800">Tracking Delivery...</h4>
                </div>
                <button @click="$dispatch('open-chat', { orderId: {{ $activeOrder->id }}, userType: 'user' })" class="bg-white px-4 py-2 rounded-xl text-xs font-bold text-orange-500 shadow-sm border border-orange-100 hover:bg-orange-50 transition">Chat Restaurant</button>
            </div>
        </div>
        @else
        <div class="bg-white rounded-3xl shadow-sm border border-zinc-100 p-12 text-center">
            <div class="w-20 h-20 bg-zinc-50 rounded-full flex items-center justify-center mx-auto mb-6 text-3xl">🍲</div>
            <h3 class="text-xl font-bold text-zinc-800 mb-2">No active orders</h3>
            <p class="text-zinc-500 mb-8 max-w-xs mx-auto">Hungry? Explore our delicious heritage menus and start your next culinary journey!</p>
            <a href="{{ route('explore') }}" class="inline-block bg-[#B25C18] text-white px-8 py-3 rounded-full font-bold shadow-lg shadow-orange-900/20 hover:scale-105 transition">Start Exploring</a>
        </div>
        @endif

        <!-- Order History List -->
        <div>
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-2xl font-bold text-zinc-800">Order History</h2>
                    <p class="text-sm text-zinc-500">Your past culinary investments</p>
                </div>
            </div>

            <div class="space-y-4">
                @forelse($allOrders->where('status', 'completed') as $order)
                <div class="bg-white rounded-2xl p-5 border border-zinc-100 shadow-sm hover:shadow-md transition-shadow flex items-center gap-6">
                    <div class="w-16 h-16 rounded-xl bg-zinc-50 flex items-center justify-center text-zinc-400 font-bold text-xl">
                        {{ $order->restaurant->name[0] }}
                    </div>
                    <div class="flex-1">
                        <h3 class="font-bold text-zinc-800 text-lg mb-1">{{ $order->restaurant->name }}</h3>
                        <div class="flex items-center gap-3 text-xs text-zinc-500">
                            <span>{{ $order->created_at->format('M d, Y') }}</span>
                            <span class="text-zinc-200">|</span>
                            <span>{{ count($order->items) }} Items</span>
                            <span class="text-zinc-200">|</span>
                            <span class="font-bold text-zinc-700">@currency($order->total)</span>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <span class="bg-zinc-100 text-zinc-500 text-[10px] font-bold uppercase tracking-widest px-4 py-2 rounded-full">Delivered</span>
                        @if(!$order->review)
                        <button @click="$dispatch('openReviewModal', { orderId: {{ $order->id }} })" class="bg-[#B25C18]/10 text-[#B25C18] text-[10px] font-bold uppercase tracking-widest px-4 py-2 rounded-full hover:bg-[#B25C18]/20 transition">Review</button>
                        @else
                        <div class="flex items-center gap-1 bg-green-50 text-green-600 text-[10px] font-bold uppercase tracking-widest px-4 py-2 rounded-full">
                            <span>⭐ {{ $order->review->rating }}</span>
                        </div>
                        @endif
                        <a href="{{ route('restaurant.show', $order->restaurant_id) }}" class="bg-orange-50 text-orange-600 text-[10px] font-bold uppercase tracking-widest px-4 py-2 rounded-full hover:bg-orange-100 transition">Reorder</a>
                    </div>
                </div>
                @empty
                <p class="text-zinc-400 text-center py-10">No past orders found.</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Sidebar with Real Address Data -->
    <div class="space-y-8">
        <div class="bg-white rounded-3xl shadow-sm border border-zinc-100 p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-bold text-zinc-800">Destination</h3>
                @php $primaryAddress = $savedAddresses->where('is_primary', true)->first() ?? $savedAddresses->first(); @endphp
                @if($primaryAddress)
                    <span class="bg-orange-100 text-orange-700 text-[10px] font-bold uppercase tracking-widest px-3 py-1 rounded-full">{{ $primaryAddress->label }}</span>
                @endif
            </div>

            @if($primaryAddress)
            <div class="mb-6 rounded-2xl overflow-hidden border border-zinc-100 shadow-inner">
                <div class="relative w-full h-40 bg-zinc-50">
                    <!-- Dynamic map would go here, placeholder for now -->
                    <div class="absolute inset-0 flex items-center justify-center text-zinc-300">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m6 13l5.447-2.724a1 1 0 011.447.894V5.618a1 1 0 01-1.447-.894L15 7m-6 13V7m6 10V7"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="flex items-start gap-3 mb-6">
                <div class="w-10 h-10 rounded-xl bg-orange-50 flex items-center justify-center flex-shrink-0">
                    📍
                </div>
                <div class="flex-1">
                    <h4 class="font-bold text-zinc-800">{{ $primaryAddress->label }}</h4>
                    <p class="text-xs text-zinc-500 leading-relaxed">{{ $primaryAddress->address_line }}, {{ $primaryAddress->city }}</p>
                </div>
            </div>
            @else
            <div class="text-center py-8 bg-zinc-50 rounded-2xl mb-6">
                <p class="text-xs text-zinc-400">No primary address set</p>
            </div>
            @endif

            <div class="pt-6 border-t border-zinc-50">
                <h4 class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest mb-4">Saved Locations</h4>
                <div class="space-y-2">
                    @foreach($savedAddresses as $address)
                    <div class="w-full flex items-center justify-between p-3 bg-zinc-50 rounded-xl transition group">
                        <div class="flex items-center gap-3">
                            <span class="text-sm font-bold text-zinc-800">{{ $address->label }}</span>
                        </div>
                        <button wire:click="deleteAddress({{ $address->id }})" class="opacity-0 group-hover:opacity-100 text-zinc-400 hover:text-red-500 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-zinc-800 to-black rounded-3xl shadow-xl p-8 text-white relative overflow-hidden">
            <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-orange-500/20 rounded-full blur-2xl"></div>
            <h3 class="text-xl font-bold mb-2">Culinary Gold</h3>
            <p class="text-xs text-zinc-400 mb-6 leading-relaxed">You've unlocked <span class="text-orange-400 font-bold">Free Delivery</span> for your next 3 orders!</p>
            <button class="w-full bg-white text-black font-bold text-xs py-3 rounded-xl hover:bg-orange-50 transition">
                Explore Premium
            </button>
        </div>
    </div>
</div>
