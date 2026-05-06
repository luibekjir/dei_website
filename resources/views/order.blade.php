<x-layouts::app :title="__('Your Culinary Curation')">
    <div class="min-h-screen bg-[#FEF6ED] text-[#1A1A1A]">
        <div class="mx-auto max-w-7xl px-6 py-8">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <!-- <a href="{{ route('restaurant') }}"
                    class="inline-flex items-center gap-3 text-sm font-semibold text-[#6D3C0F] transition hover:text-[#7A4E1B]">
                    <span
                        class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-white text-[#B25C18] shadow-sm">←</span>
                    Culinary Atelier
                </a> -->

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
                                    class="inline-flex items-center rounded-full bg-[#FFFAF5] px-4 py-2 text-sm font-semibold text-[#B25C18]">2
                                    dishes selected</span>
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
                                    <article
                                        class="overflow-hidden rounded-[1.75rem] border border-[#F1D9C6] bg-[#FFF7F0] p-5 shadow-sm sm:p-6">
                                        <div class="grid gap-6 grid-cols-[120px_1fr] items-center">
                                            <img src="https://images.unsplash.com/photo-1514516870920-364f6ea4b4a8?auto=format&fit=crop&w=500&q=80"
                                                alt="Miso-Glazed Salmon"
                                                class="h-24 w-24 rounded-[1.5rem] object-cover sm:h-32 sm:w-32" />
                                            <div class="flex flex-col justify-between gap-4">
                                                <div>
                                                    <div
                                                        class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
                                                        <div>
                                                            <h3 class="text-xl font-semibold text-[#1D1D1B]">Miso-Glazed
                                                                Salmon</h3>
                                                            <p class="mt-3 text-sm leading-6 text-[#6F5F51]">Atlantic
                                                                salmon, 48-hour white miso marinade, charred bok choy,
                                                                and ginger emulsion.</p>
                                                        </div>
                                                        <span class="text-lg font-semibold text-[#B25C18]">145,000
                                                            IDR</span>
                                                    </div>
                                                </div>

                                                <div class="flex flex-wrap items-center justify-between gap-4">
                                                    <div
                                                        class="inline-flex items-center rounded-full border border-[#EAD5C0] bg-white px-3 py-2 text-sm text-[#7A4E1B] shadow-sm">
                                                        <button
                                                            class="h-9 w-9 rounded-full text-[#B25C18] transition hover:bg-[#F8E5D6]">−</button>
                                                        <span class="mx-3 font-semibold">1</span>
                                                        <button
                                                            class="h-9 w-9 rounded-full text-[#B25C18] transition hover:bg-[#F8E5D6]">+</button>
                                                    </div>
                                                    <button
                                                        class="text-sm font-semibold text-[#C13F34] transition hover:text-[#9B2B27]">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </article>

                                    <article
                                        class="overflow-hidden rounded-[1.75rem] border border-[#F1D9C6] bg-[#FFF7F0] p-5 shadow-sm sm:p-6">
                                        <div class="grid gap-6 grid-cols-[120px_1fr] items-center">
                                            <img src="https://images.unsplash.com/photo-1512621776951-a57141f2eefd?auto=format&fit=crop&w=500&q=80"
                                                alt="Truffle Pasta"
                                                class="h-24 w-24 rounded-[1.5rem] object-cover sm:h-32 sm:w-32" />
                                            <div class="flex flex-col justify-between gap-4">
                                                <div>
                                                    <div
                                                        class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
                                                        <div>
                                                            <h3 class="text-xl font-semibold text-[#1D1D1B]">Truffle
                                                                Pasta</h3>
                                                            <p class="mt-3 text-sm leading-6 text-[#6F5F51]">Handmade
                                                                tagliatelle, Umbrian black truffle, cultured butter, and
                                                                24-month aged Parmigiano.</p>
                                                        </div>
                                                        <span class="text-lg font-semibold text-[#B25C18]">185,000
                                                            IDR</span>
                                                    </div>
                                                </div>

                                                <div class="flex flex-wrap items-center justify-between gap-4">
                                                    <div
                                                        class="inline-flex items-center rounded-full border border-[#EAD5C0] bg-white px-3 py-2 text-sm text-[#7A4E1B] shadow-sm">
                                                        <button
                                                            class="h-9 w-9 rounded-full text-[#B25C18] transition hover:bg-[#F8E5D6]">−</button>
                                                        <span class="mx-3 font-semibold">1</span>
                                                        <button
                                                            class="h-9 w-9 rounded-full text-[#B25C18] transition hover:bg-[#F8E5D6]">+</button>
                                                    </div>
                                                    <button
                                                        class="text-sm font-semibold text-[#C13F34] transition hover:text-[#9B2B27]">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                                {{-- Delivery section moved to order summary --}}
                            </section>

                                {{-- <section
                                    class="rounded-[2rem] bg-[#FFF3E4] p-8 shadow-[0_25px_70px_rgba(194,107,23,0.08)]">
                                    <p class="text-xs uppercase tracking-[0.28em] text-[#C26C1C]">Completing your
                                        meal?</p>
                                    <h3 class="mt-4 text-xl font-semibold text-[#1D1D1B]">Our signature Lavender
                                        Crème Brûlée is often paired with your items.</h3>
                                    <p class="mt-4 text-sm leading-6 text-[#6B5A4A]">Add a sweet finish to your
                                        order with a dessert crafted to complement your selection.</p>
                                    <a href="#"
                                        class="mt-6 inline-flex w-full items-center justify-center rounded-full bg-[#F8E2CE] px-5 py-3 text-sm font-semibold text-[#B15C18] shadow-sm transition hover:bg-[#F3D8C6]">Add
                                        for 65,000 IDR</a>
                                </section> --}}
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
                                            <span>330,000 IDR</span>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <span>Taxes (10%)</span>
                                            <span>33,000 IDR</span>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <span>Delivery Fee</span>
                                            <span>19,000 IDR</span>
                                        </div>
                                    </div>

                                    <div class="mt-6 border-t border-[#F1D0B6] pt-6">
                                        <div
                                            class="flex items-center justify-between text-lg font-semibold text-[#8F4C11]">
                                            <span>Total Amount</span>
                                            <span>382,000 IDR</span>
                                        </div>
                                    </div>

                                    <div class="mt-6 space-y-5">
                                        <div class="flex items-center gap-4">
                                            <div
                                                class="inline-flex h-12 w-12 items-center justify-center rounded-3xl bg-[#FCE9D9] text-[#D86F1D] shadow-sm">
                                                ⚡</div>
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
                                                <p class="mt-2">Delivery in 45–55 mins with an added fee of 19,000
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
                    </section>
                </div>
            </div>
        </div>
</x-layouts::app>