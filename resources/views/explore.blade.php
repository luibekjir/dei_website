<x-layouts::app :title="__('Explore')">
    <div class="min-h-screen bg-[#F8F3EC] text-[#1F1F1F]">
        <!-- Main Content -->
        <div class="flex">
            <!-- Sidebar -->
            <aside class="w-[280px] min-h-screen bg-white border-r border-neutral-200 px-6 py-8">
                <h2 class="text-3xl font-bold text-[#E67E22]">Explore</h2>
                <p class="text-sm tracking-[0.2em] text-gray-500 uppercase mt-1">
                    Find Your Next Meal
                </p>

                <!-- Budget Range -->
                <div class="mt-10">
                    <h3 class="font-semibold text-lg">Budget Range</h3>
                    <div class="mt-4">
                        <div class="h-1 bg-[#F4D3B2] rounded-full"></div>
                        <div class="flex justify-between text-sm text-gray-500 mt-2">
                            <span>$</span>
                            <span>$$$</span>
                        </div>
                    </div>
                </div>

                <!-- Min Rating -->
                <div class="mt-8">
                    <h3 class="font-semibold text-lg">Min. Rating</h3>
                    <div class="flex gap-2 mt-4 flex-wrap">
                        <button class="px-4 py-2 rounded-lg bg-[#F4A261] text-white font-medium">4.5+</button>
                        <button class="px-4 py-2 rounded-lg bg-[#F5F1EB]">4.0+</button>
                        <button class="px-4 py-2 rounded-lg bg-[#F5F1EB]">3.5+</button>
                    </div>
                </div>

                <!-- Distance -->
                <div class="mt-8">
                    <h3 class="font-semibold text-lg">Distance (Miles)</h3>
                    <div class="flex gap-3 mt-4">
                        <button class="flex-1 rounded-xl border border-neutral-200 p-3 text-left bg-[#F9F6F1]">
                            <p class="text-xs text-gray-500">WITHIN</p>
                            <p class="font-semibold">2 Miles</p>
                        </button>
                        <button class="flex-1 rounded-xl border border-[#F4A261] p-3 text-left bg-white">
                            <p class="text-xs text-[#E67E22] font-semibold">ACTIVE</p>
                            <p class="font-semibold">5 Miles</p>
                        </button>
                    </div>
                </div>

                <!-- Categories -->
                <div class="mt-8">
                    <h3 class="font-semibold text-lg">Categories</h3>
                    <div class="flex flex-wrap gap-2 mt-4">
                        <span class="px-4 py-2 rounded-full bg-[#F5E6D3]">Italian</span>
                        <span class="px-4 py-2 rounded-full bg-[#F4A261] text-white">Japanese</span>
                        <span class="px-4 py-2 rounded-full bg-[#F5E6D3]">Vegan</span>
                        <span class="px-4 py-2 rounded-full bg-[#F5E6D3]">Artisan Bakery</span>
                        <span class="px-4 py-2 rounded-full bg-[#F5E6D3]">French</span>
                    </div>
                </div>

                <!-- Reset -->
                <button class="mt-16 w-full rounded-xl bg-[#F5F1EB] py-4 font-medium">
                    Reset Filters
                </button>
            </aside>

            <!-- Content Area -->
            <main class="flex-1 px-10 py-8">
                <!-- Top Heading -->
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h1 class="text-5xl font-bold">Curated for your palate</h1>
                        <p class="text-gray-500 mt-2">Showing 128 results in <span class="font-semibold text-black">San
                                Francisco, CA</span></p>
                    </div>

                    <div class="flex gap-3">
                        <button class="px-6 py-3 rounded-full bg-white border border-neutral-200 font-medium">
                            Grid
                        </button>
                        <button class="px-6 py-3 rounded-full bg-white border border-neutral-200 text-gray-500">
                            Map
                        </button>
                    </div>
                </div>

                <!-- Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                    @foreach ([['title' => 'Mizumi Atelier', 'tag' => 'Japanese', 'rating' => '4.9'], ['title' => 'Pasta & Petals', 'tag' => 'Italian', 'rating' => '4.7'], ['title' => 'Flora Kitchen', 'tag' => 'Vegan', 'rating' => '4.8'], ['title' => 'Grains of Gold', 'tag' => 'Bakery', 'rating' => '4.9']] as $item)
                        <a href="/order">
                            <div class="rounded-2xl overflow-hidden bg-white border border-neutral-200 shadow-sm">
                                <div class="h-56 bg-neutral-200"></div>
                                <div class="p-5">
                                    <span
                                        class="inline-block px-3 py-1 text-xs rounded-full bg-[#F5E6D3] text-[#A65D1B] mb-3">
                                        {{ $item['tag'] }}
                                    </span>
                                    <h3 class="text-2xl font-semibold">{{ $item['title'] }}</h3>
                                    <p class="text-gray-500 mt-2 text-sm">
                                        Elevated dining experience with carefully curated flavors.
                                    </p>
                                    <div class="flex justify-between items-center mt-5 text-sm">
                                        <span class="font-semibold text-[#E67E22]">$$$</span>
                                        <span class="text-gray-500">0.8 miles away</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                <!-- Load More -->
                <div class="flex justify-center mt-10">
                    <button class="px-10 py-4 rounded-full bg-white border border-neutral-200 font-medium shadow-sm">
                        Load more culinary gems
                    </button>
                </div>
            </main>
        </div>
    </div>
</x-layouts::app>
