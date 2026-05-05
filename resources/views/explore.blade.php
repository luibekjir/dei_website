<x-layouts::app :title="__('Explore')">
    <div class="min-h-screen bg-[#F8F3EC] text-[#1F1F1F]">
        <div class="flex">

            <!-- Sidebar -->
            <aside class="w-[280px] min-h-screen bg-white border-r border-neutral-200 px-6 py-8">
                <h2 class="text-3xl font-bold text-[#E67E22]">Explore</h2>
                <p class="text-sm tracking-[0.2em] text-gray-500 uppercase mt-1">
                    Find Your Next Meal
                </p>

                <!-- Budget Range -->
                <div class="mt-8">
                    <h3 class="font-semibold text-lg">Budget Range</h3>
                    <div class="flex gap-2 mt-4 flex-wrap">

                        <a
                            href="{{ route('explore', array_merge(request()->query(), ['budget' => 1])) }}"
                            class="px-4 py-2 rounded-lg {{ request('budget') == 1 ? 'bg-[#F4A261] text-white font-medium' : 'bg-[#F5F1EB]' }}"
                        >
                            $
                        </a>

                        <a
                            href="{{ route('explore', array_merge(request()->query(), ['budget' => 2])) }}"
                            class="px-4 py-2 rounded-lg {{ request('budget') == 2 ? 'bg-[#F4A261] text-white font-medium' : 'bg-[#F5F1EB]' }}"
                        >
                            $$
                        </a>

                        <a
                            href="{{ route('explore', array_merge(request()->query(), ['budget' => 3])) }}"
                            class="px-4 py-2 rounded-lg {{ request('budget') == 3 ? 'bg-[#F4A261] text-white font-medium' : 'bg-[#F5F1EB]' }}"
                        >
                            $$$
                        </a>

                        <a
                            href="{{ route('explore', array_merge(request()->query(), ['budget' => 4])) }}"
                            class="px-4 py-2 rounded-lg {{ request('budget') == 4 ? 'bg-[#F4A261] text-white font-medium' : 'bg-[#F5F1EB]' }}"
                        >
                            $$$$
                        </a>

                    </div>
                </div>

                <!-- Rating -->
                <div class="mt-8">
                    <h3 class="font-semibold text-lg">Min. Rating</h3>
                    <div class="flex gap-2 mt-4 flex-wrap">

                        <a
                            href="{{ route('explore', array_merge(request()->query(), ['rating' => 4.5])) }}"
                            class="px-4 py-2 rounded-lg {{ request('rating') == 4.5 ? 'bg-[#F4A261] text-white font-medium' : 'bg-[#F5F1EB]' }}"
                        >
                            4.5+
                        </a>

                        <a
                            href="{{ route('explore', array_merge(request()->query(), ['rating' => 4.0])) }}"
                            class="px-4 py-2 rounded-lg {{ request('rating') == 4.0 ? 'bg-[#F4A261] text-white font-medium' : 'bg-[#F5F1EB]' }}"
                        >
                            4.0+
                        </a>

                        <a
                            href="{{ route('explore', array_merge(request()->query(), ['rating' => 3.5])) }}"
                            class="px-4 py-2 rounded-lg {{ request('rating') == 3.5 ? 'bg-[#F4A261] text-white font-medium' : 'bg-[#F5F1EB]' }}"
                        >
                            3.5+
                        </a>

                    </div>
                </div>

                <!-- Categories -->
                <div class="mt-8">
                    <h3 class="font-semibold text-lg">Categories</h3>
                    <div class="flex flex-wrap gap-2 mt-4">

                        @foreach($categories as $category)
                            <a
                                href="{{ route('explore', array_merge(request()->query(), ['category' => $category->id])) }}"
                                class="px-4 py-2 rounded-full text-sm
                                    {{ request('category') == $category->id
                                        ? 'bg-[#F4A261] text-white font-medium'
                                        : 'bg-[#F5E6D3]' }}"
                            >
                                {{ $category->name }}
                            </a>
                        @endforeach

                    </div>
                </div>

                <!-- Reset -->
                <a
                    href="{{ route('explore') }}"
                    class="mt-16 w-full block text-center rounded-xl bg-[#F5F1EB] py-4 font-medium"
                >
                    Reset Filters
                </a>
            </aside>

            <!-- Content Area -->
            <main class="flex-1 px-10 py-8">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h1 class="text-5xl font-bold">Curated for your palate</h1>
                        <p class="text-gray-500 mt-2">
                            Showing {{ $restaurants->count() }} curated restaurant results
                        </p>
                    </div>
                </div>

                <!-- Restaurant Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

                    @forelse($restaurants as $restaurant)
                        <div class="rounded-2xl overflow-hidden bg-white border border-neutral-200 shadow-sm">

                            <!-- Image -->
                            <div class="h-56 bg-neutral-200 overflow-hidden">
                                @if($restaurant->image)
                                    <img
                                        src="{{ asset('storage/' . $restaurant->image) }}"
                                        alt="{{ $restaurant->name }}"
                                        class="w-full h-full object-cover"
                                    >
                                @else
                                    <div class="w-full h-full bg-neutral-200"></div>
                                @endif
                            </div>

                            <!-- Content -->
                            <div class="p-5">

                                <span class="inline-block px-3 py-1 text-xs rounded-full bg-[#F5E6D3] text-[#A65D1B] mb-3">
                                    {{ $restaurant->category->name }}
                                </span>

                                <h3 class="text-2xl font-semibold">
                                    {{ $restaurant->name }}
                                </h3>

                                <p class="text-gray-500 mt-2 text-sm line-clamp-2">
                                    {{ $restaurant->description }}
                                </p>

                                <div class="flex justify-between items-center mt-5 text-sm">
                                    <span class="font-semibold text-[#E67E22]">
                                        {{ $restaurant->budget_range }}
                                    </span>

                                    <span class="text-gray-500">
                                        ⭐ {{ number_format($restaurant->rating, 1) }}
                                    </span>
                                </div>

                                <p class="text-xs text-gray-400 mt-3">
                                    {{ $restaurant->address }}
                                </p>

                            </div>
                        </div>

                    @empty
                        <div class="col-span-full text-center py-20">
                            <h3 class="text-2xl font-semibold">
                                No restaurants found
                            </h3>
                            <p class="text-gray-500 mt-2">
                                Try adjusting your filters
                            </p>
                        </div>
                    @endforelse

                </div>
            </main>
        </div>
    </div>
</x-layouts::app>