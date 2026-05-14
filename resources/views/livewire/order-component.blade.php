<div>
    <div class="min-h-screen bg-[#FEF6ED] text-[#1A1A1A]">
        <div class="mx-auto max-w-7xl px-6 py-12 lg:px-8">
            <header class="flex flex-col gap-6 md:flex-row md:items-end md:justify-between mb-16">
                <div>
                    <p class="text-[10px] uppercase tracking-[0.4em] text-[#AB7B45] font-bold">Secure Checkout</p>
                    <h1 class="mt-3 text-5xl font-bold tracking-tight text-[#1D1D1B] sm:text-7xl">Review Your <br/><span class="text-[#B25C18]">Culinary Order</span></h1>
                </div>
                <div class="flex items-center gap-3 rounded-full border border-[#F0DECB] bg-white px-6 py-3 text-sm font-medium text-[#6F5F51]">
                    <span class="h-2 w-2 rounded-full bg-green-500 animate-pulse"></span>
                    Ready for fulfillment
                </div>
            </header>

            <div class="grid grid-cols-1 lg:grid-cols-[1fr_400px] gap-12 items-start">
                <div class="space-y-12">
                    <section>
                        <h2 class="text-2xl font-bold text-[#1D1D1B] mb-8">Selected Delicacies</h2>
                        <div class="space-y-6">
                            @foreach($items as $index => $item)
                            <article class="flex flex-col sm:flex-row items-start sm:items-center gap-6 p-6 bg-white rounded-[2.5rem] border border-[#F0DECB] shadow-sm transition hover:shadow-md">
                                <div class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-[1.5rem] bg-[#F4E6D9]">
                                    @if(isset($item['image']))
                                        <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="h-full w-full object-cover" />
                                    @else
                                        <div class="h-full w-full flex items-center justify-center text-[#AB7B45] font-bold">{{ $item['name'][0] }}</div>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between mb-2">
                                        <h3 class="text-xl font-bold text-[#1D1D1B] truncate">{{ $item['name'] }}</h3>
                                        <span class="text-lg font-semibold text-[#B25C18]">@currency($item['price'])</span>
                                    </div>
                                    <div class="flex items-center justify-between mt-4">
                                        <div class="flex items-center bg-[#FCE9D9] rounded-full p-1">
                                            <button wire:click="updateQuantity({{ $index }}, {{ $item['quantity'] - 1 }})" class="h-8 w-8 flex items-center justify-center rounded-full text-[#B25C18] hover:bg-white transition-colors">−</button>
                                            <span class="mx-4 text-sm font-bold text-[#1D1D1B]">{{ $item['quantity'] }}</span>
                                            <button wire:click="updateQuantity({{ $index }}, {{ $item['quantity'] + 1 }})" class="h-8 w-8 flex items-center justify-center rounded-full text-[#B25C18] hover:bg-white transition-colors">+</button>
                                        </div>
                                        <button wire:click="removeItem({{ $index }})" class="text-xs font-bold text-red-500 hover:underline uppercase tracking-widest">Remove</button>
                                    </div>
                                </div>
                            </article>
                            @endforeach

                            @if(empty($items))
                            <div class="py-20 text-center bg-white rounded-[2.5rem] border-2 border-dashed border-[#F0DECB]">
                                <span class="text-5xl">🛒</span>
                                <h3 class="mt-4 text-lg font-bold text-[#1D1D1B]">Your cart is empty</h3>
                                <p class="text-sm text-[#6F5F51] mt-2">Go back to explore and find some treasures!</p>
                            </div>
                            @endif
                        </div>
                    </section>

                    <section class="space-y-8">
                        <div class="flex items-center gap-4">
                            <div class="h-12 w-12 rounded-2xl bg-orange-50 flex items-center justify-center text-xl">
                                {{ $orderType === 'delivery' ? '🚚' : '🏪' }}
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold text-[#1D1D1B]">Order Preferences</h2>
                                <p class="text-sm text-[#6F5F51]">Choose how you want to receive your order.</p>
                            </div>
                        </div>

                        <!-- Order Type Selection -->
                        <div class="flex flex-col sm:flex-row gap-2 sm:gap-4 p-2 sm:p-1 bg-[#FCE9D9] rounded-3xl sm:rounded-2xl w-full sm:w-fit">
                            @if($restaurant?->has_delivery)
                                <button wire:click="setOrderType('delivery')" 
                                    class="flex-1 px-8 py-3 rounded-2xl sm:rounded-xl font-bold transition-all {{ $orderType === 'delivery' ? 'bg-[#B25C18] text-white shadow-lg' : 'text-[#B25C18] hover:bg-white/50' }}">
                                    Delivery
                                </button>
                            @endif
                            @if($restaurant?->supports_pickup)
                                <button wire:click="setOrderType('pickup')" 
                                    class="flex-1 px-8 py-3 rounded-2xl sm:rounded-xl font-bold transition-all {{ $orderType === 'pickup' ? 'bg-[#B25C18] text-white shadow-lg' : 'text-[#B25C18] hover:bg-white/50' }}">
                                    Pickup
                                </button>
                            @endif
                        </div>

                        <!-- Contextual Section -->
                        @if($orderType === 'delivery')
                            <div class="p-8 bg-white rounded-[2.5rem] border border-[#F0DECB]">
                                <h3 class="text-sm font-bold uppercase tracking-widest text-[#AB7B45] mb-6">Delivery Fee Negotiation</h3>
                                
                                @if($negotiationStatus === 'none')
                                    <div class="flex flex-col sm:flex-row items-center gap-4">
                                        <div class="flex items-center bg-[#FCE9D9] rounded-full p-1 flex-1 w-full sm:w-auto">
                                            <button wire:click="adjustNegotiatedFee(-1000)" class="h-10 w-10 flex items-center justify-center rounded-full text-[#B25C18] hover:bg-white transition-colors">−</button>
                                            <span class="flex-1 text-center font-bold text-[#1D1D1B]">@currency($negotiatedDeliveryFee)</span>
                                            <button wire:click="adjustNegotiatedFee(1000)" class="h-10 w-10 flex items-center justify-center rounded-full text-[#B25C18] hover:bg-white transition-colors">+</button>
                                        </div>
                                        <button wire:click="negotiateDeliveryFee" class="w-full sm:w-auto bg-[#B25C18] text-white px-8 py-3 rounded-full font-bold shadow-md hover:bg-[#8F4C11] transition-colors">
                                            Nego Now
                                        </button>
                                    </div>
                                    <p class="mt-4 text-[10px] text-[#AB7B45] uppercase tracking-wider">Default fee: @currency($deliveryFee)</p>
                                @elseif($negotiationStatus === 'pending')
                                    <div class="space-y-4 animate-pulse">
                                        <p class="text-sm font-bold text-[#B25C18]">Waiting for driver's response...</p>
                                        <div class="flex gap-3">
                                            <button wire:click="simulateDriverResponse" class="bg-green-600 text-white px-4 py-2 rounded-xl text-xs font-bold">Mock Accept</button>
                                            <button wire:click="rejectNegotiation" class="bg-red-600 text-white px-4 py-2 rounded-xl text-xs font-bold">Mock Reject</button>
                                        </div>
                                    </div>
                                @elseif($negotiationStatus === 'accepted')
                                    <div class="flex items-center gap-3 text-green-600 font-bold">
                                        <span>✅ Negotiation Accepted!</span>
                                        <span class="text-sm px-3 py-1 bg-green-50 rounded-full">New Fee: @currency($deliveryFee)</span>
                                    </div>
                                @elseif($negotiationStatus === 'rejected')
                                    <div class="flex items-center justify-between">
                                        <span class="text-red-600 font-bold">❌ Driver declined.</span>
                                        <button wire:click="$set('negotiationStatus', 'none')" class="text-xs font-bold text-[#B25C18] hover:underline uppercase">Try Again</button>
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="p-8 bg-white rounded-[2.5rem] border border-[#F0DECB] flex flex-col md:flex-row items-center gap-6">
                                <div class="h-20 w-20 rounded-3xl bg-[#FEF6ED] flex items-center justify-center text-3xl shadow-inner">🏪</div>
                                <div class="flex-1 text-center md:text-left">
                                    <h3 class="text-xl font-bold text-[#1D1D1B]">Self-Pickup Order</h3>
                                    <p class="text-sm text-[#6F5F51] mt-1">Anda akan mengambil pesanan langsung di restoran. Tidak ada biaya pengiriman.</p>
                                    <div class="mt-4 inline-flex items-center gap-2 text-[10px] font-bold text-[#B25C18] uppercase tracking-widest bg-[#FCE9D9] px-3 py-1 rounded-full">
                                        📍 {{ $restaurant->address ?? 'Lokasi Restoran' }}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </section>
                </div>

                <aside class="lg:sticky lg:top-10 space-y-6">
                    <div class="bg-white rounded-[2.5rem] border border-[#F0DECB] p-8 shadow-sm">
                        <h2 class="text-xl font-bold text-[#1D1D1B] mb-8">Payment Summary</h2>
                        
                        <div class="space-y-4 mb-8">
                            <div class="flex justify-between text-sm text-[#6F5F51]">
                                <span>Subtotal</span>
                                <span class="font-bold text-[#1D1D1B]">@currency($subtotal)</span>
                            </div>
                            <div class="flex justify-between text-sm text-[#6F5F51]">
                                <span>Pajak (10%)</span>
                                <span class="font-bold text-[#1D1D1B]">@currency($taxes)</span>
                            </div>
                            <div class="flex justify-between text-sm text-[#6F5F51]">
                                <span>Biaya Antar</span>
                                <span class="font-bold text-[#1D1D1B]">@currency($deliveryFee)</span>
                            </div>
                            <div class="pt-4 border-t border-[#F0DECB] flex justify-between">
                                <span class="font-bold text-[#1D1D1B]">Total</span>
                                <span class="text-2xl font-bold text-[#B25C18]">@currency($total)</span>
                            </div>
                        </div>

                        <button wire:click="startPayment" 
                            wire:loading.attr="disabled"
                            @disabled(empty($items)) 
                            class="w-full bg-[#B25C18] text-white py-4 rounded-full font-bold shadow-lg hover:bg-[#8F4C11] transition-all active:scale-95 disabled:opacity-50 disabled:grayscale flex items-center justify-center gap-3">
                            <span wire:loading.remove>Proceed to Payment</span>
                            <span wire:loading class="flex items-center gap-2">
                                <svg class="animate-spin h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Connecting...
                            </span>
                        </button>
                        
                        <div class="mt-6 flex items-center justify-center gap-2 text-[10px] text-[#AB7B45] font-bold uppercase tracking-widest">
                            <span class="text-green-600">🛡️</span> Secure & Encrypted
                        </div>
                    </div>

                    <div class="bg-[#FFF7F0] rounded-[2rem] p-6 border border-[#FEEBD8]">
                        <p class="text-[10px] uppercase tracking-widest text-[#B25C18] font-bold mb-3">Chef's Note</p>
                        <p class="text-xs text-[#6F5F51] leading-relaxed italic">"Every dish is a piece of heritage. We ensure it reaches you with the same warmth it left our kitchen."</p>
                    </div>
                </aside>
            </div>
        </div>
    </div>

    <!-- Midtrans QRIS Simulation -->
    @if($paymentStatus === 'processing' || $paymentStatus === 'awaiting-payment')
    <div class="fixed inset-0 z-[100] flex items-center justify-center bg-[#1D1D1B]/80 backdrop-blur-md px-6 animate-in fade-in duration-500">
        <div class="w-full max-w-md overflow-hidden rounded-[3.5rem] bg-white shadow-2xl animate-in zoom-in-95 duration-500">
            <!-- Midtrans Branding Header -->
            <div class="bg-[#FFF7F0] p-8 flex items-center justify-between border-b border-[#FEEBD8]">
                <div class="flex items-center gap-3">
                    <img src="https://midtrans.com/assets/img/midtrans-logo.svg" alt="Midtrans" class="h-5">
                    <div class="h-4 w-[1px] bg-zinc-300"></div>
                    <span class="text-[10px] font-bold text-[#B25C18] uppercase tracking-[0.2em]">Secure Payment</span>
                </div>
                <button wire:click="$set('paymentStatus', 'idle')" class="text-zinc-400 hover:text-zinc-600 transition-colors">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <div class="p-8">
                <div class="text-center mb-10">
                    <h3 class="text-xs font-bold text-zinc-400 uppercase tracking-[0.3em] mb-2">Order #AT-{{ rand(1000, 9999) }}</h3>
                    <p class="text-4xl font-black text-[#1D1D1B]">@currency($total)</p>
                </div>

                <!-- QRIS Section -->
                <div class="bg-white border-2 border-dashed border-zinc-100 rounded-[2.5rem] p-8 flex flex-col items-center mb-8 relative group">
                    <div class="absolute top-4 left-4 flex gap-1">
                        <div class="h-2 w-2 rounded-full bg-green-500 animate-pulse"></div>
                        <span class="text-[8px] font-bold text-green-600 uppercase tracking-tighter">Live Simulator</span>
                    </div>
                    
                    @if($qrCodeUrl)
                        <div class="relative w-full aspect-square max-w-[240px] bg-white p-4 rounded-3xl shadow-inner border border-zinc-50">
                            <img src="{{ $qrCodeUrl }}" alt="QRIS Code" class="w-full h-full object-contain">
                            <div class="absolute inset-0 bg-white/0 group-hover:bg-white/10 transition-colors pointer-events-none"></div>
                        </div>
                    @endif

                    <div class="mt-8 flex items-center gap-4">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/a/a2/Logo_QRIS.svg" class="h-6" alt="QRIS">
                        <div class="h-4 w-[1px] bg-zinc-200"></div>
                        <div class="flex gap-3 opacity-60">
                            <img src="https://midtrans.com/assets/img/payment-methods/gopay.svg" class="h-3" alt="GoPay">
                            <img src="https://midtrans.com/assets/img/payment-methods/ovo.svg" class="h-3" alt="OVO">
                            <img src="https://midtrans.com/assets/img/payment-methods/shopeepay.svg" class="h-3" alt="ShopeePay">
                        </div>
                    </div>
                </div>

                <!-- Instructions -->
                <div class="space-y-4 mb-10">
                    <p class="text-[10px] font-bold text-[#AB7B45] uppercase tracking-widest text-center">How to pay</p>
                    <div class="grid grid-cols-3 gap-3 text-center">
                        <div class="space-y-1">
                            <div class="text-sm font-bold text-zinc-800">1. Scan</div>
                            <p class="text-[9px] text-zinc-400 leading-tight">Open your e-wallet app & scan code</p>
                        </div>
                        <div class="space-y-1">
                            <div class="text-sm font-bold text-zinc-800">2. Confirm</div>
                            <p class="text-[9px] text-zinc-400 leading-tight">Check amount & enter your PIN</p>
                        </div>
                        <div class="space-y-1">
                            <div class="text-sm font-bold text-zinc-800">3. Done</div>
                            <p class="text-[9px] text-zinc-400 leading-tight">Wait for success notification</p>
                        </div>
                    </div>
                </div>

                <!-- Simulated Actions -->
                <div class="space-y-3">
                    <button wire:click="checkPaymentStatus" class="w-full bg-[#B25C18] text-white py-5 rounded-3xl font-black uppercase tracking-[0.2em] shadow-xl hover:scale-[1.02] active:scale-95 transition-all text-xs flex items-center justify-center gap-2">
                        <span wire:loading.remove wire:target="checkPaymentStatus">Check Payment Status</span>
                        <span wire:loading wire:target="checkPaymentStatus" class="flex items-center gap-2">
                            <svg class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Checking...
                        </span>
                    </button>
                    <button wire:click="completePayment" class="w-full bg-[#1D1D1B] text-white py-5 rounded-3xl font-black uppercase tracking-[0.2em] shadow-xl hover:scale-[1.02] active:scale-95 transition-all text-xs">
                        Simulate Payment Success (Local Only)
                    </button>
                    <button wire:click="$set('paymentStatus', 'idle')" class="w-full text-zinc-400 py-2 rounded-2xl font-bold hover:text-zinc-600 transition-all text-[10px] uppercase tracking-widest">
                        Pay with other method
                    </button>
                </div>
            </div>

            <div class="bg-zinc-50 p-6 flex justify-center items-center gap-4 opacity-40">
                <img src="https://midtrans.com/assets/img/payment-methods/visa.svg" class="h-3">
                <img src="https://midtrans.com/assets/img/payment-methods/mastercard.svg" class="h-5">
                <img src="https://midtrans.com/assets/img/payment-methods/bca.svg" class="h-3">
            </div>
        </div>
    </div>
    @endif
</div>
