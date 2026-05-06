<div>
    <div class="min-h-screen bg-[#FEF6ED] text-[#1A1A1A]">
        <div class="mx-auto max-w-7xl px-6 py-8">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <a href=""
                    class="inline-flex items-center gap-3 text-sm font-semibold text-[#6D3C0F] transition hover:text-[#7A4E1B]">
                    <span
                        class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-white text-[#B25C18] shadow-sm">←</span>
                    Culinary Atelier
                </a>

                <div class="rounded-[1.75rem] border border-[#E9D6C3] bg-white px-6 py-4 text-right shadow-sm sm:px-7">
                    <p class="text-xs uppercase tracking-[0.28em] text-[#AB7B45]">Order #CA-8829</p>
                    <p class="mt-2 text-sm text-[#6B5A4A]">Today, 18:42</p>
                </div>
            </div>

            <div class="mt-10 grid gap-8 grid-cols-[1.7fr_1fr]">
                <div class="space-y-8">
                    <section class="rounded-[2rem] bg-white p-8 shadow-[0_25px_80px_rgba(194,107,23,0.12)]">
                        <div>
                            <h1 class="text-4xl font-semibold text-[#1D1D1B] sm:text-5xl">Your Culinary Curation</h1>
                            <div class="mt-3 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                                <p class="text-sm text-[#6B5A4A]">Order #CA-8829 • Today, 18:42</p>
                                <span
                                    class="inline-flex items-center rounded-full bg-[#FFFAF5] px-4 py-2 text-sm font-semibold text-[#B25C18]">{{ count($items) }} dishes selected</span>
                            </div>
                        </div>
                    </section>

                    <section class="flex">
                        <div class="">
                            <section class="rounded-[2rem] bg-white p-8 shadow-[0_25px_80px_rgba(194,107,23,0.12)]">
                                <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                                    <div>
                                        <p class="text-xs uppercase tracking-[0.28em] text-[#AB7B45]">Selected
                                            Delicacies</p>
                                        <h2 class="mt-4 text-2xl font-semibold text-[#1D1D1B]">Review your order</h2>
                                    </div>
                                    <p class="max-w-xl text-sm text-[#6B5A4A]">Adjust quantities or remove items before
                                        checkout. Order summary appears on the right.</p>
                                </div>

                                <div class="mt-8 space-y-5">
                                    @foreach($items as $index => $item)
                                    <article
                                        class="overflow-hidden rounded-[1.75rem] border border-[#F1D9C6] bg-[#FFF7F0] p-5 shadow-sm sm:p-6">
                                        <div class="grid gap-6 grid-cols-[120px_1fr] items-center">
                                            <img src="{{ $item['image'] }}"
                                                alt="{{ $item['name'] }}"
                                                class="h-24 w-24 rounded-[1.5rem] object-cover sm:h-32 sm:w-32" />
                                            <div class="flex flex-col justify-between gap-4">
                                                <div>
                                                    <div
                                                        class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
                                                        <div>
                                                            <h3 class="text-xl font-semibold text-[#1D1D1B]">{{ $item['name'] }}</h3>
                                                            <p class="mt-3 text-sm leading-6 text-[#6F5F51]">Description here.</p>
                                                        </div>
                                                        <span class="text-lg font-semibold text-[#B25C18]">{{ number_format($item['price'], 0, ',', '.') }} IDR</span>
                                                    </div>
                                                </div>

                                                <div class="flex flex-wrap items-center justify-between gap-4">
                                                    <div
                                                        class="inline-flex items-center rounded-full border border-[#EAD5C0] bg-white px-3 py-2 text-sm text-[#7A4E1B] shadow-sm">
                                                        <button wire:click="updateQuantity({{ $index }}, {{ $item['quantity'] - 1 }})"
                                                            class="h-9 w-9 rounded-full text-[#B25C18] transition hover:bg-[#F8E5D6]">−</button>
                                                        <span class="mx-3 font-semibold">{{ $item['quantity'] }}</span>
                                                        <button wire:click="updateQuantity({{ $index }}, {{ $item['quantity'] + 1 }})"
                                                            class="h-9 w-9 rounded-full text-[#B25C18] transition hover:bg-[#F8E5D6]">+</button>
                                                    </div>
                                                    <button wire:click="removeItem({{ $index }})"
                                                        class="text-sm font-semibold text-[#C13F34] transition hover:text-[#9B2B27]">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                    @endforeach
                                </div>
                            </section>
                        </div>
                    </section>
                </div>

                <aside class="space-y-6 lg:sticky lg:top-20">
                    <section
                        class="rounded-[2rem] bg-white p-8 shadow-[0_25px_80px_rgba(194,107,23,0.12)]">
                        <div class="space-y-5">
                            <div>
                                <p class="text-xs uppercase tracking-[0.28em] text-[#AB7B45]">Order
                                    Summary</p>
                                <h2 class="mt-3 text-3xl font-semibold text-[#1D1D1B]">Order Summary
                                </h2>
                            </div>

                            <div class="space-y-3 text-sm text-[#6B5A4A]">
                                <div class="flex items-center justify-between">
                                    <span>Subtotal</span>
                                    <span>{{ number_format($subtotal, 0, ',', '.') }} IDR</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span>Taxes (10%)</span>
                                    <span>{{ number_format($taxes, 0, ',', '.') }} IDR</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span>Delivery Fee</span>
                                    <span>{{ number_format($deliveryFee, 0, ',', '.') }} IDR</span>
                                </div>
                            </div>

                            <div class="mt-6 border-t border-[#F1D0B6] pt-6">
                                <div
                                    class="flex items-center justify-between text-lg font-semibold text-[#8F4C11]">
                                    <span>Total Amount</span>
                                    <span>{{ number_format($total, 0, ',', '.') }} IDR</span>
                                </div>
                            </div>

                            <!-- Negotiation Section -->
                            <div class="mt-6 space-y-4">
                                <div class="flex items-center gap-4">
                                    <div class="inline-flex h-12 w-12 items-center justify-center rounded-3xl bg-[#FCE9D9] text-[#D86F1D] shadow-sm">
                                        💬
                                    </div>
                                    <div>
                                        <h2 class="text-xl font-semibold text-[#1D1D1B]">Negotiate Delivery Fee</h2>
                                        <p class="mt-2 text-sm text-[#6B5A4A]">Discuss delivery cost with your driver.</p>
                                    </div>
                                </div>

                                @if($negotiationStatus === 'none')
                                <div class="space-y-3">
                                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                                        <div class="inline-flex items-center rounded-full border border-[#EAD5C0] bg-white px-3 py-2 text-sm text-[#7A4E1B] shadow-sm">
                                            <button wire:click="adjustNegotiatedFee(-1000)"
                                                    class="h-9 w-9 rounded-full text-[#B25C18] transition hover:bg-[#F8E5D6]">−</button>
                                            <input type="number" wire:model="negotiatedDeliveryFee"
                                                   min="1000" step="1000"
                                                   class="w-24 bg-transparent text-center text-sm font-semibold focus:outline-none"
                                                   aria-label="Negotiated delivery fee" />
                                            <button wire:click="adjustNegotiatedFee(1000)"
                                                    class="h-9 w-9 rounded-full text-[#B25C18] transition hover:bg-[#F8E5D6]">+</button>
                                        </div>
                                        <button wire:click="negotiateDeliveryFee"
                                                class="rounded-lg bg-[#B25C18] px-4 py-2 text-sm font-semibold text-white transition hover:bg-[#8F4C11]">
                                            Negotiate
                                        </button>
                                    </div>
                                    <div class="text-xs text-[#6B5A4A]">
                                        <p>Current fee: {{ number_format($deliveryFee, 0, ',', '.') }} IDR</p>
                                        <p>Proposed fee: {{ number_format($negotiatedDeliveryFee, 0, ',', '.') }} IDR</p>
                                    </div>
                                </div>
                                @elseif($negotiationStatus === 'pending')
                                <div class="rounded-3xl border border-[#F2D7BD] bg-[#FFF4E6] px-4 py-4 text-sm text-[#6B5A4A]">
                                    <p class="font-semibold text-[#8F4C11]">Negotiation Pending</p>
                                    <p class="mt-2">{{ $negotiationMessage }}</p>
                                    <p class="mt-2 text-xs">Waiting for driver response...</p>
                                    <div class="mt-3 flex gap-2">
                                        <button wire:click="simulateDriverResponse"
                                                class="rounded bg-green-600 px-3 py-1 text-xs text-white hover:bg-green-700">
                                            Simulate Accept
                                        </button>
                                        <button wire:click="rejectNegotiation"
                                                class="rounded bg-red-600 px-3 py-1 text-xs text-white hover:bg-red-700">
                                            Simulate Reject
                                        </button>
                                    </div>
                                </div>
                                @elseif($negotiationStatus === 'accepted')
                                <div class="rounded-3xl border border-green-200 bg-green-50 px-4 py-4 text-sm text-green-800">
                                    <p class="font-semibold">Negotiation Accepted!</p>
                                    <p class="mt-2">New delivery fee: {{ number_format($negotiatedDeliveryFee, 0, ',', '.') }} IDR</p>
                                </div>
                                @elseif($negotiationStatus === 'rejected')
                                <div class="rounded-3xl border border-red-200 bg-red-50 px-4 py-4 text-sm text-red-800">
                                    <p class="font-semibold">Negotiation Rejected</p>
                                    <p class="mt-2">Driver declined the proposed fee.</p>
                                </div>
                                @endif
                            </div>

                            <div class="mt-6 space-y-5">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="inline-flex h-12 w-12 items-center justify-center rounded-3xl bg-[#FCE9D9] text-[#D86F1D] shadow-sm">⚡</div>
                                    <div>
                                        <h2 class="text-xl font-semibold text-[#1D1D1B]">Choose Delivery
                                            Speed & Fee</h2>
                                        <p class="mt-2 text-sm text-[#6B5A4A]">Set your delivery speed so
                                            your food arrives exactly when you want it.</p>
                                    </div>
                                </div>

                                <div class="space-y-4">
                                    <input type="range" min="1" max="3" value="2"
                                        class="w-full accent-[#D17623]" />
                                    <div
                                        class="grid grid-cols-3 gap-4 text-center text-xs uppercase tracking-[0.25em] text-[#A77B4D]">
                                        <span>Economy</span>
                                        <span class="font-semibold text-[#7A4E1B]">Priority</span>
                                        <span>Express</span>
                                    </div>
                                    <div
                                        class="rounded-3xl border border-[#F2D7BD] bg-[#FFF4E6] px-4 py-4 text-sm text-[#6B5A4A]">
                                        <p class="font-semibold text-[#8F4C11]">Priority selected</p>
                                        <p class="mt-2">Delivery in 45–55 mins with an added fee of {{ number_format($deliveryFee, 0, ',', '.') }}
                                            IDR.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button
                            class="mt-8 w-full rounded-full bg-gradient-to-r from-[#C56A1E] to-[#F1A25A] px-6 py-4 text-sm font-semibold text-black shadow-lg transition hover:opacity-95">
                            Proceed to Payment
                        </button>

                        <p class="mt-5 flex items-center gap-2 text-xs text-[#6B5A4A]"><span
                                class="inline-flex h-7 w-7 items-center justify-center rounded-full bg-[#F0D2B8] text-[#B35E18]">🔒</span>
                            Secure encrypted checkout</p>
                    </section>
                </aside>
            </div>
        </div>
    </div>
</div>