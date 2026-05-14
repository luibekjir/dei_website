<div class="min-h-screen bg-[#FEF6ED] text-[#1A1A1A]">
    <div class="mx-auto max-w-7xl px-6 py-8">
        <header class="relative overflow-hidden rounded-[2.5rem] bg-white p-8 shadow-[0_20px_60px_rgba(194,107,23,0.1)] lg:p-12">
            <div class="relative z-10 flex flex-col gap-10 lg:flex-row lg:items-center">
                <div class="h-64 w-full overflow-hidden rounded-[2rem] bg-[#F4E6D9] lg:h-80 lg:w-[450px] shrink-0">
                    @if($restaurant->image)
                        <img src="{{ asset('storage/' . $restaurant->image) }}" alt="{{ $restaurant->name }}" class="h-full w-full object-cover" />
                    @else
                        <div class="h-full w-full flex items-center justify-center bg-zinc-200">
                            <span class="text-zinc-400 italic text-sm">Welcome to {{ $restaurant->name }}</span>
                        </div>
                    @endif
                </div>

                <div class="flex-1 space-y-6">
                    <div class="space-y-2">
                        <p class="text-[10px] uppercase tracking-[0.3em] text-[#AB7B45] font-bold">{{ $restaurant->category->name }} • {{ $restaurant->city->name }}</p>
                        <h1 class="text-4xl font-bold tracking-tight text-[#1D1D1B] sm:text-6xl">{{ $restaurant->name }}</h1>
                    </div>

                    <div class="flex flex-wrap items-center gap-6 text-sm font-medium">
                        <div class="flex items-center gap-2 rounded-full bg-orange-50 px-4 py-2 text-orange-700">
                            <span class="text-lg">⭐</span>
                            <span class="font-bold">{{ number_format($restaurant->rating, 1) }}</span>
                            <span class="text-[#AB7B45]/60 font-normal ml-1">Excellent curation</span>
                        </div>
                    </div>

                    <p class="max-w-2xl text-lg leading-relaxed text-[#6F5F51]">{{ $restaurant->description }}</p>

                    <div class="flex flex-wrap items-center gap-4 pt-4">
                        <button class="inline-flex items-center rounded-full bg-[#B25C18] px-8 py-4 text-sm font-semibold text-white shadow-lg transition hover:bg-[#8F4C11] hover:scale-[1.02] active:scale-95">
                            Start Order
                        </button>
                        <div class="flex items-center gap-2 rounded-full border border-[#F0DECB] px-6 py-4 text-sm font-medium text-[#6F5F51]">
                            <span class="h-2 w-2 rounded-full bg-green-500"></span>
                            Currently Open
                        </div>
                    </div>
                </div>
            </div>
        </header>

        @if($restaurant->facilities)
            <section class="mt-16">
                <h2 class="text-2xl font-bold text-[#1D1D1B]">Establishment Amenities</h2>
                <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach($restaurant->facilities as $category => $items)
                        <div class="rounded-[2rem] bg-white p-8 shadow-sm border border-[#F0DECB]">
                            <h3 class="mb-6 flex items-center gap-2 text-xs uppercase tracking-widest text-[#AB7B45] font-bold">
                                <span class="text-xl">
                                    @if($category == 'Accessibility') ♿ @elseif($category == 'Amenities') ✨ @else 🅿️ @endif
                                </span>
                                {{ $category }}
                            </h3>
                            <ul class="space-y-4">
                                @foreach($items as $facility)
                                    <li class="flex items-start gap-3 text-sm text-[#6F5F51]">
                                        <span class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-green-50 text-green-600">
                                            <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </span>
                                        {{ $facility }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <section class="mt-16">
            <div class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
                <div>
                    <h2 class="text-3xl font-semibold text-[#1D1D1B]">Menu Selection</h2>
                </div>

                <div class="flex flex-wrap items-center gap-3">
                    <a href="{{ route('order') }}" class="inline-flex items-center rounded-full bg-[#5C3611] px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#4F2F0E]">
                        View Order ({{ $cartCount }})
                    </a>
                </div>
            </div>

            @if($highlightedMenu)
            <div class="mt-10">
                <p class="text-[10px] uppercase tracking-[0.3em] text-[#B25C18] font-bold mb-6">Your Highlighted Selection</p>
                <article class="overflow-hidden rounded-[2.5rem] border-2 border-[#B25C18] bg-[#FFF9F4] shadow-xl flex flex-col lg:flex-row">
                    <div class="h-64 w-full lg:h-80 lg:w-[400px] flex-shrink-0 overflow-hidden">
                        @if($highlightedMenu->image)
                            <img src="{{ asset('storage/' . $highlightedMenu->image) }}" alt="{{ $highlightedMenu->name }}" class="h-full w-full object-cover" />
                        @else
                            <div class="h-full w-full flex items-center justify-center bg-[#F4E6D9]">
                                <span class="text-[#AB7B45] font-bold text-6xl">{{ $highlightedMenu->name[0] }}</span>
                            </div>
                        @endif
                    </div>
                    <div class="p-8 lg:p-10 flex flex-col justify-center space-y-6">
                        <div class="space-y-2">
                            <div class="flex items-center gap-2">
                                <span class="bg-[#B25C18] text-white text-[10px] font-bold uppercase tracking-widest px-3 py-1 rounded-full">Selected Choice</span>
                                @if($highlightedMenu->is_halal)
                                    <span class="bg-green-600 text-white text-[10px] font-bold uppercase tracking-widest px-3 py-1 rounded-full">Halal</span>
                                @endif
                            </div>
                            <h3 class="text-3xl lg:text-4xl font-bold text-[#1D1D1B]">{{ $highlightedMenu->name }}</h3>
                        </div>
                        <p class="text-base lg:text-lg text-[#6F5F51] leading-relaxed max-w-xl">{{ $highlightedMenu->description }}</p>
                        <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-6">
                            <span class="text-2xl lg:text-3xl font-bold text-[#B25C18]">@currency($highlightedMenu->price)</span>
                            <button wire:click="addToOrder({{ $highlightedMenu->id }})" class="rounded-full bg-[#B25C18] px-8 py-4 text-sm font-bold text-white shadow-lg transition hover:bg-[#8F4C11] active:scale-95">
                                + Add to Order
                            </button>
                        </div>
                    </div>
                </article>
                <div class="mt-16 h-px bg-[#F0DECB]"></div>
            </div>
            @endif

            <div class="mt-10 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                @foreach ($restaurant->menuItems as $item)
                    @if(isset($highlightId) && $highlightId == $item->id)
                        @continue
                    @endif
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
                                <span class="text-lg font-semibold text-[#B25C18]">@currency($item->price)</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="flex items-center text-xs font-semibold text-orange-500 bg-orange-50 px-2 py-0.5 rounded-full">
                                    ⭐ {{ number_format($item->rating, 1) }}
                                </span>
                                @if($item->is_halal)
                                    <span class="text-[10px] uppercase font-bold text-green-600 bg-green-50 px-2 py-0.5 rounded-full">Halal</span>
                                @endif
                            </div>
                            <p class="text-sm leading-6 text-[#6F5F51]">{{ $item->description }}</p>
                            <button wire:click="addToOrder({{ $item->id }})" class="inline-flex w-full items-center justify-center rounded-full bg-[#F5E7D6] px-4 py-3 text-sm font-semibold text-[#7A4E1B] transition hover:bg-[#E9D0B3]">
                                + Add to Order
                            </button>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>
        <section class="mt-24 mb-20">
            <div class="flex items-center justify-between mb-10">
                <h2 class="text-3xl font-bold text-[#1D1D1B]">Customer Reviews</h2>
                <div class="flex items-center gap-2 text-[#AB7B45] font-bold">
                    <span class="text-2xl">⭐</span>
                    <span class="text-xl">{{ $restaurant->average_rating }}</span>
                    <span class="text-sm font-normal text-[#6F5F51] ml-1">({{ $restaurant->reviews->count() }} reviews)</span>
                </div>
            </div>

            <div class="grid gap-8 md:grid-cols-2">
                @forelse($restaurant->reviews as $review)
                <div class="bg-white rounded-[2rem] p-8 border border-zinc-100 shadow-sm relative group overflow-hidden">
                    <div class="absolute top-0 right-0 p-8">
                        <div class="flex gap-0.5">
                            @for($i = 1; $i <= 5; $i++)
                            <svg class="w-4 h-4 {{ $review->rating >= $i ? 'text-orange-400 fill-current' : 'text-zinc-200 fill-none' }}" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                            </svg>
                            @endfor
                        </div>
                    </div>

                    <div class="flex items-start gap-5">
                        <div class="w-14 h-14 rounded-2xl bg-orange-50 border border-orange-100 flex items-center justify-center text-orange-700 font-bold text-xl shadow-inner">
                            {{ strtoupper(substr($review->user->name, 0, 1)) }}
                        </div>
                        <div class="space-y-4 flex-1">
                            <div>
                                <h4 class="font-bold text-zinc-800">{{ $review->user->name }}</h4>
                                <p class="text-[10px] text-zinc-400 uppercase tracking-widest font-bold mt-1">{{ $review->created_at->diffForHumans() }}</p>
                            </div>
                            <p class="text-[#6F5F51] leading-relaxed italic">"{{ $review->comment }}"</p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-2 py-20 text-center bg-white rounded-[3rem] border-2 border-dashed border-zinc-100">
                    <div class="text-4xl mb-4 opacity-30">✨</div>
                    <p class="text-zinc-400 italic">No reviews yet. Be the first to share your experience!</p>
                </div>
                @endforelse
            </div>
        </section>
    </div>
</div>
