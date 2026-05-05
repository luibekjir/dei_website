<x-layouts::app :title="$restaurant->name">
    <div class="min-h-screen bg-[#FEF6ED] text-[#1A1A1A]">
        <div class="mx-auto max-w-7xl px-6 py-8">
            <section class="space-y-10">
                <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                    <div class="max-w-2xl">
                        <p class="text-sm uppercase tracking-[0.28em] text-[#AB7B45]">CulinaryAtelier</p>
                        <h1 class="mt-4 text-4xl font-semibold tracking-tight text-[#1D1D1B] sm:text-5xl">{{ $restaurant->name }}</h1>
                        <div class="mt-5 flex flex-wrap gap-4 text-sm text-[#6B5A4A]">
                            <span class="inline-flex items-center gap-2">
                                <span class="inline-flex h-2.5 w-2.5 rounded-full bg-[#E5902C]"></span>
                                {{ $restaurant->address }}
                            </span>
                            <span class="inline-flex items-center gap-2">
                                <span class="rounded-full bg-[#F8E7D3] px-2 py-1 text-xs font-semibold text-[#A5621B]">{{ number_format($restaurant->rating, 1) }}</span>
                                {{ $restaurant->category->name }}
                            </span>
                        </div>
                    </div>

                    <a href="#" class="inline-flex items-center justify-center rounded-full border border-[#E3C1A5] bg-white px-6 py-3 text-sm font-semibold text-[#6D3C0F] shadow-sm transition hover:bg-[#FCF0E4]">
                        Chat with Restaurant
                    </a>
                </div>

                <div class="grid gap-8 lg:grid-cols-[1.35fr_0.65fr] items-start">
                    <div class="overflow-hidden rounded-[2rem] bg-[#F7E8DD] shadow-[0_40px_100px_rgba(226,146,67,0.16)]">
                        @if($restaurant->image)
                            <img src="{{ asset('storage/' . $restaurant->image) }}" alt="{{ $restaurant->name }}" class="h-full w-full object-cover" />
                        @else
                            <div class="h-full w-full flex items-center justify-center bg-zinc-200">
                                <span class="text-zinc-400 italic">No image available</span>
                            </div>
                        @endif
                    </div>

                    <div class="flex min-h-full flex-col justify-between rounded-[2rem] bg-white p-8 shadow-[0_40px_100px_rgba(226,146,67,0.12)]">
                        <div>
                            <span class="text-xs uppercase tracking-[0.28em] text-[#E38B28]">{{ $restaurant->category->name }}</span>
                            <h2 class="mt-6 text-4xl font-bold tracking-tight text-[#161616] sm:text-5xl">{{ $restaurant->name }}</h2>
                            <p class="mt-6 max-w-xl text-sm leading-7 text-[#6F5F51]">
                                {{ $restaurant->description }}
                            </p>
                        </div>

                        <div class="mt-10 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                            <span class="text-3xl font-semibold text-[#B25C18]">{{ $restaurant->budget_range }}</span>
                            <a href="#" class="inline-flex items-center justify-center rounded-full bg-[#B35F17] px-8 py-3 text-sm font-semibold text-white shadow-lg transition hover:bg-[#9A4F16]">
                                Order Now
                            </a>
                        </div>
                    </div>
                </div>
            </section>

            <section class="mt-16">
                <div class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
                    <div>
                        <h2 class="text-3xl font-semibold text-[#1D1D1B]">Full Menu</h2>
                    </div>

                    <div class="flex flex-wrap items-center gap-3">
                        <a href="{{ route('order') }}" class="inline-flex items-center rounded-full bg-[#5C3611] px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#4F2F0E]">
                            View Order (3)
                        </a>
                    </div>
                </div>

                <div class="mt-10 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                    @foreach ($restaurant->menus as $item)
                        <article class="overflow-hidden rounded-[2rem] border border-[#F0DECB] bg-white shadow-sm">
                            <div class="h-56 overflow-hidden rounded-t-[2rem] bg-[#F4E6D9]">
                                @if($item->image)
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="h-full w-full object-cover" />
                                @else
                                    <div class="h-full w-full flex items-center justify-center bg-zinc-200">
                                        <span class="text-zinc-400 italic">No image available</span>
                                    </div>
                                @endif
                            </div>
                            <div class="space-y-4 px-6 py-6">
                                <div class="flex items-center justify-between gap-4">
                                    <h3 class="text-xl font-semibold text-[#161616]">{{ $item->name }}</h3>
                                    <span class="text-lg font-semibold text-[#B25C18]">${{ number_format($item->price, 2) }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="flex items-center text-xs font-semibold text-orange-500 bg-orange-50 px-2 py-0.5 rounded-full">
                                        ⭐ {{ number_format($item->rating, 1) }}
                                    </span>
                                </div>
                                <p class="text-sm leading-6 text-[#6F5F51]">{{ $item->description }}</p>
                                <button class="inline-flex w-full items-center justify-center rounded-full bg-[#F5E7D6] px-4 py-3 text-sm font-semibold text-[#7A4E1B] transition hover:bg-[#E9D0B3]">
                                    + Add to Order
                                </button>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>

            <footer class="mt-16 rounded-[2rem] bg-[#F7EEE6] p-10 text-[#6A513A] shadow-sm">
                <div class="grid gap-10 lg:grid-cols-3">
                    <div class="space-y-4">
                        <p class="text-2xl font-semibold text-[#9B5F2A]">CulinaryAtelier</p>
                        <p class="max-w-sm text-sm leading-7 text-[#6F5F51]">Celebrating the intersection of heritage flavors and modern gastronomy. Our mission is to curate the world’s most authentic culinary experiences.</p>
                    </div>
                    <div class="space-y-3">
                        <p class="text-sm font-semibold uppercase tracking-[0.24em] text-[#8D6540]">The Atelier</p>
                        <ul class="space-y-2 text-sm text-[#6F5F51]">
                            <li><a href="#" class="hover:text-[#7A4E1B]">Our Story</a></li>
                            <li><a href="#" class="hover:text-[#7A4E1B]">Chef’s Table</a></li>
                            <li><a href="#" class="hover:text-[#7A4E1B]">Sustainability</a></li>
                        </ul>
                    </div>
                    <div class="space-y-3">
                        <p class="text-sm font-semibold uppercase tracking-[0.24em] text-[#8D6540]">Support</p>
                        <ul class="space-y-2 text-sm text-[#6F5F51]">
                            <li><a href="#" class="hover:text-[#7A4E1B]">Contact</a></li>
                            <li><a href="#" class="hover:text-[#7A4E1B]">FAQs</a></li>
                            <li><a href="#" class="hover:text-[#7A4E1B]">Delivery Areas</a></li>
                        </ul>
                    </div>
                </div>
                <div class="mt-10 border-t border-[#E8D7C7] pt-6 text-sm text-[#8A6A4F] flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <span>© 2024 CulinaryAtelier. All rights reserved.</span>
                    <div class="flex flex-wrap gap-4">
                        <a href="#" class="hover:text-[#7A4E1B]">Privacy Policy</a>
                        <a href="#" class="hover:text-[#7A4E1B]">Terms of Service</a>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</x-layouts::app>
