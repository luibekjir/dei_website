<x-layouts::app :title="__('Home')">
    <div class="min-h-screen bg-[#fdfbf7] font-sans text-[#1f1a17]">
        
        {{-- NAVBAR --}}
        <header class="mx-auto flex max-w-7xl items-center justify-between px-6 py-6">
            <div class="text-xl font-black tracking-tight text-[#1f1a17]">
                Culinary<span class="font-bold">Atelier</span>
            </div>
            <nav class="hidden space-x-8 md:flex">
                <a href="#" class="text-sm font-semibold text-[#1f1a17]">Explore</a>
                <a href="#" class="text-sm font-semibold text-[#6a5b51]">How it works</a>
            </nav>
            <div>
                <a href="#" class="rounded-full bg-[#955215] px-6 py-2.5 text-sm font-bold text-white transition hover:bg-[#7a4210]">
                    Log in
                </a>
            </div>
        </header>

        {{-- HERO SECTION --}}
        <section class="mx-auto max-w-7xl px-6 py-10 lg:py-16">
            <div class="grid items-center gap-12 lg:grid-cols-2">
                <div class="pr-8">
                    <h1 class="max-w-xl text-5xl font-black leading-[1.05] tracking-tight sm:text-[4rem]">
                        Find <span class="text-[#955215] italic">Affordable</span><br>
                        Food Near You
                    </h1>
                    <p class="mt-6 max-w-lg text-lg leading-relaxed text-[#6a5b51]">
                        A sensory guide helping migrants and travelers discover authentic local flavors without breaking the bank. Your digital kitchen table awaits.
                    </p>

                    <div class="mt-10 inline-flex flex-col items-center rounded-[2rem] bg-[#f8f4ec] p-2 shadow-sm sm:flex-row">
                        <div class="flex items-center gap-3 px-4 py-2 sm:px-6">
                            <svg class="h-5 w-5 text-[#955215]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <span class="text-sm text-[#8c7f72] whitespace-nowrap">Where are<br>you eating?</span>
                        </div>
                        <div class="hidden h-10 w-px bg-[#e6dbce] sm:block"></div>
                        <div class="flex items-center gap-3 px-4 py-2 sm:px-6">
                            <svg class="h-5 w-5 text-[#955215]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                            <span class="flex items-center gap-2 text-sm text-[#8c7f72]">
                                Budget (A 
                                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                )
                            </span>
                        </div>
                        <button class="mt-2 w-full rounded-full bg-[#955215] px-8 py-3.5 text-sm font-bold text-white transition hover:bg-[#7a4210] sm:mt-0 sm:ml-2 sm:w-auto">
                            Search
                        </button>
                    </div>
                </div>

                <div class="relative flex items-center justify-center gap-4 sm:gap-6 lg:justify-end">
                    <div class="z-10 h-[320px] w-[240px] shrink-0 overflow-hidden rounded-[2rem] shadow-xl sm:h-[380px] sm:w-[280px]">
                        <img src="{{ asset('images/makanan1.png') }}" alt="Hero Image 1" class="h-full w-full object-cover">
                    </div>
                    <div class="flex h-[260px] w-[240px] shrink-0 items-center justify-center overflow-hidden rounded-[2rem] bg-white shadow-xl sm:h-[300px] sm:w-[260px]">
                        <img src="{{ asset('images/makanan2.png') }}" alt="Hero Image 2" class="h-full w-full object-contain p-4">
                    </div>
                </div>
            </div>
        </section>

        {{-- BACKGROUND SEPARATOR --}}
        <div class="bg-[#fcf8f2] py-20">
            
            {{-- CURATED RECOMMENDATIONS --}}
            <section class="mx-auto max-w-7xl px-6">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <h2 class="text-3xl font-black tracking-tight text-[#1f1a17]">Curated Recommendations</h2>
                        <p class="mt-2 max-w-xl text-sm leading-6 text-[#6a5b51]">
                            Hand-picked spots known for exceptional quality and migrant-friendly pricing.
                        </p>
                    </div>
                    <a href="#" class="flex items-center gap-1 font-bold text-[#955215] hover:underline">
                        View All <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>

                <div class="mt-10 grid gap-6 md:grid-cols-3">
                    {{-- Card 1 --}}
                    <article class="flex flex-col overflow-hidden rounded-[2rem] bg-white shadow-sm transition hover:shadow-md">
                        <div class="relative h-60 w-full overflow-hidden">
                            <img src="{{ asset('images/makanan3.png') }}" alt="Saigon Street Eats" class="absolute inset-0 h-full w-full object-cover">
                            <div class="absolute left-4 top-4 flex items-center gap-1 rounded-full bg-white/95 px-3 py-1 text-sm font-bold shadow-sm backdrop-blur-md">
                                <span class="text-[#d97706]">★</span> 4.9
                            </div>
                        </div>
                        <div class="flex flex-1 flex-col p-6">
                            <div class="flex items-start justify-between gap-4">
                                <h3 class="text-xl font-bold text-[#1f1a17]">Saigon Street Eats</h3>
                                <span class="shrink-0 text-base font-black text-[#955215]">$7.50</span>
                            </div>
                            <p class="mt-3 flex-1 text-sm leading-6 text-[#6a5b51]">Authentic family recipes passed down through generations. Known for the...</p>
                            <div class="mt-6 flex flex-wrap gap-2">
                                <span class="rounded-full bg-[#f2e9dc] px-4 py-1.5 text-[11px] font-bold text-[#7a5e42]">Vietnamese</span>
                                <span class="rounded-full bg-[#f2e9dc] px-4 py-1.5 text-[11px] font-bold text-[#7a5e42]">Budget friendly</span>
                            </div>
                        </div>
                    </article>

                    {{-- Card 2 --}}
                    <article class="flex flex-col overflow-hidden rounded-[2rem] bg-white shadow-sm transition hover:shadow-md">
                        <div class="relative h-60 w-full overflow-hidden">
                            <img src="{{ asset('images/makanan4.png') }}" alt="Abyssinia House" class="absolute inset-0 h-full w-full object-cover">
                            <div class="absolute left-4 top-4 flex items-center gap-1 rounded-full bg-white/95 px-3 py-1 text-sm font-bold shadow-sm backdrop-blur-md">
                                <span class="text-[#d97706]">★</span> 4.8
                            </div>
                        </div>
                        <div class="flex flex-1 flex-col p-6">
                            <div class="flex items-start justify-between gap-4">
                                <h3 class="text-xl font-bold text-[#1f1a17]">Abyssinia House</h3>
                                <span class="shrink-0 text-base font-black text-[#955215]">$12.00</span>
                            </div>
                            <p class="mt-3 flex-1 text-sm leading-6 text-[#6a5b51]">A communal dining experience featuring hand-stretched injera and spice-infused...</p>
                            <div class="mt-6 flex flex-wrap gap-2">
                                <span class="rounded-full bg-[#f2e9dc] px-4 py-1.5 text-[11px] font-bold text-[#7a5e42]">Ethiopian</span>
                                <span class="rounded-full bg-[#f2e9dc] px-4 py-1.5 text-[11px] font-bold text-[#7a5e42]">Vegetarian</span>
                            </div>
                        </div>
                    </article>

                    {{-- Card 3 --}}
                    <article class="flex flex-col overflow-hidden rounded-[2rem] bg-white shadow-sm transition hover:shadow-md">
                        <div class="relative h-60 w-full overflow-hidden">
                            <img src="{{ asset('images/makanan5.png') }}" alt="Patagonia Pantry" class="absolute inset-0 h-full w-full object-cover">
                            <div class="absolute left-4 top-4 flex items-center gap-1 rounded-full bg-white/95 px-3 py-1 text-sm font-bold shadow-sm backdrop-blur-md">
                                <span class="text-[#d97706]">★</span> 4.7
                            </div>
                        </div>
                        <div class="flex flex-1 flex-col p-6">
                            <div class="flex items-start justify-between gap-4">
                                <h3 class="text-xl font-bold text-[#1f1a17]">Patagonia Pantry</h3>
                                <span class="shrink-0 text-base font-black text-[#955215]">$4.00</span>
                            </div>
                            <p class="mt-3 flex-1 text-sm leading-6 text-[#6a5b51]">The best flaky empanadas in town. Perfect for a quick bite or a full meal on...</p>
                            <div class="mt-6 flex flex-wrap gap-2">
                                <span class="rounded-full bg-[#f2e9dc] px-4 py-1.5 text-[11px] font-bold text-[#7a5e42]">Argentinian</span>
                                <span class="rounded-full bg-[#f2e9dc] px-4 py-1.5 text-[11px] font-bold text-[#7a5e42]">Street food</span>
                            </div>
                        </div>
                    </article>
                </div>
            </section>

            {{-- THE SIMPLE PATH TO FLAVOR --}}
            <section class="mx-auto mt-24 max-w-7xl px-6 text-center">
                <h2 class="text-3xl font-black tracking-tight text-[#1f1a17]">The Simple Path to Flavor</h2>
                <div class="mt-14 grid gap-10 md:grid-cols-3">
                    <div class="flex flex-col items-center">
                        <div class="flex h-20 w-20 items-center justify-center rounded-full bg-[#f8ebd8] text-2xl text-[#955215]">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <h3 class="mt-6 text-lg font-bold text-[#1f1a17]">Find</h3>
                        <p class="mt-2 text-sm leading-6 text-[#6a5b51]">Search by location to see what is cooking nearby in your neighborhood.</p>
                    </div>
                    <div class="flex flex-col items-center">
                        <div class="flex h-20 w-20 items-center justify-center rounded-full bg-[#f8ebd8] text-2xl text-[#955215]">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                        </div>
                        <h3 class="mt-6 text-lg font-bold text-[#1f1a17]">Filter</h3>
                        <p class="mt-2 text-sm leading-6 text-[#6a5b51]">Adjust your budget and cuisine preferences to find the perfect match.</p>
                    </div>
                    <div class="flex flex-col items-center">
                        <div class="flex h-20 w-20 items-center justify-center rounded-full bg-[#f8ebd8] text-2xl text-[#955215]">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="mt-6 text-lg font-bold text-[#1f1a17]">Feast</h3>
                        <p class="mt-2 text-sm leading-6 text-[#6a5b51]">Follow the directions and enjoy a high-quality, affordable meal.</p>
                    </div>
                </div>
            </section>
        </div>

        {{-- TRENDING TASTES --}}
        <section class="mx-auto max-w-7xl px-6 py-20">
            <h2 class="text-3xl font-black tracking-tight text-[#1f1a17]">Trending Tastes</h2>
            <div class="mt-10 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
                {{-- Item 1 --}}
                <article class="group cursor-pointer">
                    <div class="relative h-48 w-full overflow-hidden rounded-2xl bg-gray-200">
                        <img src="{{ asset('images/makanan1.png') }}" alt="Giant Indian Thali" class="h-full w-full object-cover transition duration-300 group-hover:scale-105">
                    </div>
                    <div class="mt-4 flex items-start justify-between gap-2">
                        <div>
                            <h3 class="text-base font-bold text-[#1f1a17]">Giant Indian Thali</h3>
                            <span class="mt-1 inline-block rounded-full bg-[#f2e9dc] px-3 py-1 text-[10px] font-bold text-[#7a5e42]">Top Seller</span>
                        </div>
                        <span class="text-sm font-bold text-[#955215]">$9.99</span>
                    </div>
                </article>

                {{-- Item 2 --}}
                <article class="group cursor-pointer">
                    <div class="relative h-48 w-full overflow-hidden rounded-2xl bg-gray-200">
                        <img src="{{ asset('images/makanan2.png') }}" alt="Crispy Soy-Garlic Chicken" class="h-full w-full object-cover transition duration-300 group-hover:scale-105">
                    </div>
                    <div class="mt-4 flex items-start justify-between gap-2">
                        <div>
                            <h3 class="text-base font-bold text-[#1f1a17]">Crispy Soy-Garlic...</h3>
                            <span class="mt-1 inline-block rounded-full bg-[#f2e9dc] px-3 py-1 text-[10px] font-bold text-[#7a5e42]">Must Try</span>
                        </div>
                        <span class="text-sm font-bold text-[#955215]">$11.50</span>
                    </div>
                </article>

                {{-- Item 3 --}}
                <article class="group cursor-pointer">
                    <div class="relative h-48 w-full overflow-hidden rounded-2xl bg-gray-200">
                        <img src="{{ asset('images/makanan3.png') }}" alt="Miso Tonkotsu Ramen" class="h-full w-full object-cover transition duration-300 group-hover:scale-105">
                    </div>
                    <div class="mt-4 flex items-start justify-between gap-2">
                        <div>
                            <h3 class="text-base font-bold text-[#1f1a17]">Miso Tonkotsu Ramen</h3>
                            <span class="mt-1 inline-block rounded-full bg-[#f2e9dc] px-3 py-1 text-[10px] font-bold text-[#7a5e42]">Popular</span>
                        </div>
                        <span class="text-sm font-bold text-[#955215]">$13.00</span>
                    </div>
                </article>

                {{-- Item 4 --}}
                <article class="group cursor-pointer">
                    <div class="relative h-48 w-full overflow-hidden rounded-2xl bg-gray-200">
                        <img src="{{ asset('images/makanan4.png') }}" alt="Classic Ahi Poke Bowl" class="h-full w-full object-cover transition duration-300 group-hover:scale-105">
                    </div>
                    <div class="mt-4 flex items-start justify-between gap-2">
                        <div>
                            <h3 class="text-base font-bold text-[#1f1a17]">Classic Ahi Poke Bowl</h3>
                            <span class="mt-1 inline-block rounded-full bg-[#f2e9dc] px-3 py-1 text-[10px] font-bold text-[#7a5e42]">Fresh</span>
                        </div>
                        <span class="text-sm font-bold text-[#955215]">$12.50</span>
                    </div>
                </article>
            </div>
        </section>

        {{-- HIDDEN GEMS (GRID LAYOUT) --}}
        <section class="mx-auto max-w-7xl px-6 pb-20">
            <h2 class="text-3xl font-black tracking-tight text-[#1f1a17]">Hidden Gems</h2>
            <div class="mt-10 grid grid-cols-1 gap-4 md:grid-cols-4 md:grid-rows-2">
                
                {{-- Kiri Besar (Col-span-2, Row-span-2) --}}
                <article class="group relative overflow-hidden rounded-3xl md:col-span-2 md:row-span-2 min-h-[400px]">
                    <img src="{{ asset('images/makanan5.png') }}" alt="Artisan Hearth Bakery" class="absolute inset-0 h-full w-full object-cover transition duration-500 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-8 text-white">
                        <p class="text-xs font-bold uppercase tracking-widest text-[#f5c48a]">Back-alley find</p>
                        <h3 class="mt-2 text-3xl font-black">Artisan Hearth Bakery</h3>
                        <p class="mt-2 text-sm text-white/80">Famous for sourdough loaves that cost less than a coffee.</p>
                    </div>
                </article>

                {{-- Kanan Atas Lebar (Col-span-2, Row-span-1) --}}
                <article class="group relative overflow-hidden rounded-3xl md:col-span-2 min-h-[200px]">
                    <img src="{{ asset('images/makanan1.png') }}" alt="Mumbai Express" class="absolute inset-0 h-full w-full object-cover transition duration-500 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-6 text-white">
                        <h3 class="text-xl font-bold">Mumbai Express</h3>
                        <p class="mt-1 text-sm text-white/80">Best samosas in the tri-state area.</p>
                    </div>
                </article>

                {{-- Kanan Bawah Kiri (Col-span-1, Row-span-1) --}}
                <article class="group relative overflow-hidden rounded-3xl md:col-span-1 min-h-[200px]">
                    <img src="{{ asset('images/makanan2.png') }}" alt="Classic Diner" class="absolute inset-0 h-full w-full object-cover transition duration-500 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-5 text-white">
                        <h3 class="text-lg font-bold">Classic Diner</h3>
                    </div>
                </article>

                {{-- Kanan Bawah Kanan (Col-span-1, Row-span-1) --}}
                <article class="group relative overflow-hidden rounded-3xl md:col-span-1 min-h-[200px]">
                    <img src="{{ asset('images/makanan3.png') }}" alt="Glaze Lab" class="absolute inset-0 h-full w-full object-cover transition duration-500 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-5 text-white">
                        <h3 class="text-lg font-bold">Glaze Lab</h3>
                    </div>
                </article>
            </div>
        </section>

        {{-- CALL TO ACTION --}}
        <section class="px-6 py-10 pb-24">
            <div class="mx-auto flex max-w-5xl flex-col items-center rounded-[2.5rem] bg-gradient-to-br from-[#cc6f22] to-[#e48b37] px-8 py-16 text-center shadow-lg sm:px-16">
                <h2 class="text-3xl font-black tracking-tight text-white sm:text-4xl">Ready to Taste Your Next Adventure?</h2>
                <p class="mt-4 max-w-2xl text-base text-white/90">Join 50,000+ travelers and migrants exploring the best local eats every day.</p>
                <div class="mt-8 flex flex-col gap-4 sm:flex-row">
                    <button class="rounded-full bg-white px-8 py-3.5 text-sm font-bold text-[#955215] transition hover:bg-gray-50">
                        Sign up free
                    </button>
                    <button class="rounded-full border-2 border-white/40 px-8 py-3.5 text-sm font-bold text-white transition hover:bg-white/10">
                        Explore Map
                    </button>
                </div>
            </div>
        </section>

        {{-- FOOTER --}}
        <footer class="border-t border-gray-200 bg-white px-6 py-12">
            <div class="mx-auto grid max-w-7xl gap-10 md:grid-cols-4">
                <div class="md:col-span-1">
                    <h3 class="text-lg font-black text-[#1f1a17]">Culinary<span class="font-bold">Atelier</span></h3>
                    <p class="mt-4 text-sm leading-6 text-[#6a5b51]">Redefining global food discovery for the modern traveler. Built for flavor, priced for everyone.</p>
                </div>
                <div>
                    <h4 class="font-bold text-[#1f1a17]">Explore</h4>
                    <ul class="mt-4 space-y-3 text-sm text-[#6a5b51]">
                        <li><a href="#" class="hover:text-[#955215]">Neighborhoods</a></li>
                        <li><a href="#" class="hover:text-[#955215]">Top Rated</a></li>
                        <li><a href="#" class="hover:text-[#955215]">New Spots</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-[#1f1a17]">Resources</h4>
                    <ul class="mt-4 space-y-3 text-sm text-[#6a5b51]">
                        <li><a href="#" class="hover:text-[#955215]">For Migrants</a></li>
                        <li><a href="#" class="hover:text-[#955215]">Traveler Guide</a></li>
                        <li><a href="#" class="hover:text-[#955215]">Partner With Us</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-[#1f1a17]">Connect</h4>
                    <div class="mt-4 flex gap-3">
                        <a href="#" class="flex h-10 w-10 items-center justify-center rounded-full bg-[#f8f4ec] text-[#955215] hover:bg-[#ebdccc]">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                        </a>
                        <a href="#" class="flex h-10 w-10 items-center justify-center rounded-full bg-[#f8f4ec] text-[#955215] hover:bg-[#ebdccc]">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="mx-auto mt-12 flex max-w-7xl flex-col items-center justify-between border-t border-gray-100 pt-8 text-xs text-gray-500 sm:flex-row">
                <p>© 2026 Culinary Atelier. All rights reserved.</p>
                <div class="mt-4 flex space-x-6 sm:mt-0">
                    <a href="#" class="hover:text-gray-900">Privacy Policy</a>
                    <a href="#" class="hover:text-gray-900">Terms of Service</a>
                    <a href="#" class="hover:text-gray-900">Cookie Settings</a>
                </div>
            </div>
        </footer>
    </div>
</x-layouts::app>