@php
    $restaurant = \App\Models\Restaurant::where('user_id', auth()->id())->first() ?? \App\Models\Restaurant::first();
@endphp

<x-layouts::app.header :title="__('Restaurant Dashboard')">
    <flux:main>
    <div class="min-h-screen bg-[#FEF6ED] text-[#1A1A1A] p-6 lg:p-10">
        <div class="mx-auto max-w-7xl space-y-10">
            <!-- Header -->
            <header class="flex flex-col gap-6 md:flex-row md:items-start md:justify-between">
                <div>
                    <p class="text-[10px] uppercase tracking-[0.3em] text-[#AB7B45] font-bold">CulinaryAtelier • Admin</p>
                    <h1 class="mt-2 text-4xl font-bold tracking-tight text-[#1D1D1B] sm:text-5xl">
                        {{ $restaurant->name }} 
                        <span class="text-2xl font-light text-[#AB7B45] ml-2">Dashboard</span>
                    </h1>
                </div>
                <div class="bg-white px-6 py-4 rounded-[2rem] border border-[#F0DECB] shadow-sm">
                    <livewire:restaurant-delivery-config :restaurantId="$restaurant->id" />
                </div>
            </header>

            <!-- Stats Section -->
            <section class="animate-in fade-in slide-in-from-top-4 duration-500">
                <livewire:restaurant-stats :restaurantId="$restaurant->id" />
            </section>

            <div class="grid gap-10 lg:grid-cols-[1.6fr_1fr]">
                <!-- Orders Section -->
                <section class="space-y-6 animate-in fade-in slide-in-from-left-4 duration-700">
                    <div class="flex items-center justify-between px-2">
                        <h2 class="text-2xl font-bold text-[#1D1D1B]">Order Management</h2>
                        <div class="flex items-center gap-2">
                            <span class="h-2 w-2 rounded-full bg-green-500 animate-pulse"></span>
                            <span class="text-[10px] uppercase font-bold tracking-wider text-[#6B5A4A]">Live Status</span>
                        </div>
                    </div>
                    <livewire:restaurant-order-management :restaurantId="$restaurant->id" />
                </section>

                <!-- Menu Section -->
                <section class="space-y-6 animate-in fade-in slide-in-from-right-4 duration-700">
                    <div class="flex items-center justify-between px-2">
                        <h2 class="text-2xl font-bold text-[#1D1D1B]">Menu Selection</h2>
                        <button class="text-xs font-bold text-[#B25C18] hover:underline">View All Items</button>
                    </div>
                    <livewire:restaurant-menu-management :restaurantId="$restaurant->id" />
                </section>
            </div>

            <!-- Delivery Rules Section -->
            <section class="space-y-6 animate-in fade-in slide-in-from-bottom-4 duration-700">
                <div class="flex items-center justify-between px-2">
                    <h2 class="text-2xl font-bold text-[#1D1D1B]">Delivery Logistics</h2>
                </div>
                <div class="rounded-[2.5rem] bg-white p-8 shadow-sm border border-[#F0DECB]">
                    <livewire:delivery-rule-management :restaurantId="$restaurant->id" />
                </div>
            </section>

            <!-- Footer / System Info -->
            <footer class="pt-10 border-t border-[#F1D9C6] flex justify-between items-center text-[10px] text-[#AB7B45] font-medium uppercase tracking-widest">
                <span>System Version 2.4.1</span>
                <span>© 2024 CulinaryAtelier OS</span>
            </footer>
        </div>
    </div>
    </flux:main>
</x-layouts::app.header>
