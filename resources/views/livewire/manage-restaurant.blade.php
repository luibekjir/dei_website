<div class="min-h-screen bg-[#FEF6ED] text-[#1A1A1A] p-6 lg:p-10 -m-6">
    <div class="mx-auto max-w-7xl space-y-10">
        <!-- Header Section -->
        <header class="flex flex-col gap-6 md:flex-row md:items-start md:justify-between">
            <div class="animate-in fade-in slide-in-from-left-4 duration-500">
                <nav class="flex items-center space-x-2 text-[10px] uppercase tracking-[0.3em] text-[#AB7B45] font-bold mb-2">
                    <a href="{{ route('profile.user') }}" class="hover:text-[#7A4900] transition-colors">My Profile</a>
                    <span>•</span>
                    <span>Restaurant Management</span>
                </nav>
                <h1 class="text-4xl font-black tracking-tight text-[#1D1D1B] sm:text-5xl uppercase">
                    {{ $restaurant->name }} 
                    <span class="text-2xl font-light text-[#AB7B45] ml-2 italic">Dashboard</span>
                </h1>
            </div>
            
            <div class="bg-white px-8 py-5 rounded-[2.5rem] border border-[#F0DECB] shadow-sm animate-in fade-in slide-in-from-right-4 duration-500">
                <div class="flex items-center gap-4">
                    <div class="h-10 w-10 bg-[#B25C18]/10 rounded-xl flex items-center justify-center text-[#B25C18]">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <livewire:restaurant-delivery-config :restaurantId="$restaurant->id" />
                </div>
            </div>
        </header>

        <!-- Stats Section -->
        <section class="animate-in fade-in slide-in-from-top-4 duration-700">
            <div class="bg-white/50 backdrop-blur-sm rounded-[3rem] p-2 border border-white/50 shadow-xl shadow-orange-900/5">
                @livewire('restaurant-stats', ['restaurantId' => $restaurant->id])
            </div>
        </section>

        <!-- Main Management Grid -->
        <div class="grid gap-10 lg:grid-cols-[1.6fr_1fr]">
            <!-- Orders Section -->
            <section class="space-y-6 animate-in fade-in slide-in-from-left-4 duration-700">
                <div class="flex items-center justify-between px-4">
                    <div class="flex items-center gap-3">
                        <div class="h-8 w-8 bg-orange-100 rounded-lg flex items-center justify-center text-orange-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-black text-[#1D1D1B] uppercase tracking-tight">Order <span class="text-[#AB7B45]">Management</span></h2>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="h-2 w-2 rounded-full bg-green-500 animate-pulse"></span>
                        <span class="text-[10px] uppercase font-black tracking-wider text-[#AB7B45]">Live Monitoring</span>
                    </div>
                </div>
                <div class="bg-white rounded-[3rem] p-8 shadow-sm border border-[#F0DECB]">
                    @livewire('restaurant-order-management', ['restaurantId' => $restaurant->id])
                </div>
            </section>

            <!-- Menu Section -->
            <section class="space-y-6 animate-in fade-in slide-in-from-right-4 duration-700">
                <div class="flex items-center justify-between px-4">
                    <div class="flex items-center gap-3">
                        <div class="h-8 w-8 bg-orange-100 rounded-lg flex items-center justify-center text-orange-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-black text-[#1D1D1B] uppercase tracking-tight">Menu <span class="text-[#AB7B45]">Curator</span></h2>
                    </div>
                </div>
                <div class="bg-white rounded-[3rem] p-8 shadow-sm border border-[#F0DECB]">
                    @livewire('restaurant-menu-management', ['restaurantId' => $restaurant->id])
                </div>
            </section>
        </div>

        <!-- Delivery Rules Section -->
        <section class="space-y-6 animate-in fade-in slide-in-from-bottom-4 duration-700">
            <div class="flex items-center justify-between px-4">
                <div class="flex items-center gap-3">
                    <div class="h-8 w-8 bg-orange-100 rounded-lg flex items-center justify-center text-orange-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-black text-[#1D1D1B] uppercase tracking-tight">Delivery <span class="text-[#AB7B45]">Logistics</span></h2>
                </div>
            </div>
            <div class="rounded-[3rem] bg-white p-10 shadow-sm border border-[#F0DECB]">
                @livewire('delivery-rule-management', ['restaurantId' => $restaurant->id])
            </div>
        </section>

        <!-- Financial Management Section -->
        <section class="space-y-6 animate-in fade-in slide-in-from-bottom-4 duration-700">
            <div class="flex items-center justify-between px-4">
                <div class="flex items-center gap-3">
                    <div class="h-8 w-8 bg-orange-100 rounded-lg flex items-center justify-center text-orange-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-black text-[#1D1D1B] uppercase tracking-tight">Financial <span class="text-[#AB7B45]">Wallet</span></h2>
                </div>
            </div>
            <div class="rounded-[3rem] bg-white/50 border border-[#F0DECB] shadow-inner overflow-hidden">
                @livewire('restaurant-wallet')
            </div>
        </section>

        <!-- Reviews Moderation Section -->
        <section class="space-y-6 animate-in fade-in slide-in-from-bottom-4 duration-700">
            <div class="flex items-center justify-between px-4">
                <div class="flex items-center gap-3">
                    <div class="h-8 w-8 bg-orange-100 rounded-lg flex items-center justify-center text-orange-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.921-.755 1.688-1.54 1.118l-3.976-2.888a1 1 0 00-1.175 0l-3.976 2.888c-.784.57-1.838-.197-1.539-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-black text-[#1D1D1B] uppercase tracking-tight">Review <span class="text-[#AB7B45]">Reputation</span></h2>
                </div>
            </div>
            <div class="rounded-[3rem] bg-white p-10 shadow-sm border border-[#F0DECB]">
                <div class="grid gap-6">
                    @forelse($restaurant->reviews()->with('user')->latest()->get() as $review)
                        <div class="flex items-start gap-6 p-6 rounded-[2rem] bg-[#FEF9F5] border border-[#F5E6D3] hover:border-orange-200 transition-all">
                            <div class="w-12 h-12 rounded-full bg-white border border-orange-100 flex items-center justify-center text-xl shadow-sm font-bold text-orange-500">
                                {{ substr($review->user->name, 0, 1) }}
                            </div>
                            <div class="flex-1">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <h4 class="font-bold text-[#1D1D1B]">{{ $review->user->name }}</h4>
                                        <p class="text-[10px] text-[#AB7B45] font-bold uppercase tracking-widest">{{ $review->created_at->diffForHumans() }}</p>
                                    </div>
                                    <div class="flex items-center gap-1 bg-white px-3 py-1 rounded-full border border-orange-100 shadow-sm">
                                        <span class="text-xs font-black text-[#B25C18]">{{ $review->rating }}.0</span>
                                        <span class="text-orange-400">⭐</span>
                                    </div>
                                </div>
                                <p class="text-sm text-[#6B5A4A] leading-relaxed italic">"{{ $review->comment }}"</p>
                            </div>
                            <div class="flex flex-col items-end gap-3">
                                <button wire:click="toggleReviewVisibility({{ $review->id }})" 
                                    class="text-[10px] px-4 py-2 rounded-full font-bold uppercase tracking-widest transition-all {{ $review->is_visible ? 'bg-green-50 text-green-700 border border-green-100 hover:bg-green-100' : 'bg-red-50 text-red-700 border border-red-100 hover:bg-red-100' }}">
                                    {{ $review->is_visible ? 'Visible' : 'Hidden' }}
                                </button>
                                <span class="text-[9px] text-[#AB7B45] font-bold uppercase tracking-tighter">Order #{{ str_pad($review->order_id, 5, '0', STR_PAD_LEFT) }}</span>
                            </div>
                        </div>
                    @empty
                        <div class="py-12 text-center bg-zinc-50/50 rounded-[2rem] border-2 border-dashed border-zinc-100">
                            <p class="text-zinc-400 font-medium italic">No reviews received yet.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="pt-10 border-t border-[#F1D9C6] flex justify-between items-center text-[10px] text-[#AB7B45] font-black uppercase tracking-[0.3em]">
            <span>System Version 2.5.0</span>
            <div class="flex items-center gap-6">
                <a href="#" class="hover:text-[#7A4900] transition-colors">Privacy</a>
                <a href="#" class="hover:text-[#7A4900] transition-colors">Security</a>
                <span>© 2024 CulinaryAtelier OS</span>
            </div>
        </footer>
    </div>
</div>
