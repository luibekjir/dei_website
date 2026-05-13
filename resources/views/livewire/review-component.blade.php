<div x-data="{ open: @entangle('showModal') }">
    @if($showModal)
    <div class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[200] flex items-center justify-center p-4">
        <div class="bg-white rounded-[3rem] w-full max-w-md overflow-hidden shadow-2xl animate-in fade-in zoom-in duration-300">
            <div class="p-10">
                <div class="text-center mb-8">
                    <div class="w-20 h-20 bg-orange-50 rounded-full flex items-center justify-center mx-auto mb-4 text-3xl">⭐</div>
                    <h2 class="text-2xl font-bold text-zinc-800">Review Your Meal</h2>
                    <p class="text-zinc-500 text-sm mt-2">How was your experience with us?</p>
                </div>

                <div class="space-y-8">
                    <!-- Star Rating -->
                    <div class="flex flex-col items-center gap-4">
                        <p class="text-xs font-bold text-zinc-400 uppercase tracking-widest">Your Rating</p>
                        <div class="flex gap-2">
                            @for($i = 1; $i <= 5; $i++)
                            <button wire:click="$set('rating', {{ $i }})" class="group transition-transform active:scale-90">
                                <svg class="w-10 h-10 {{ $rating >= $i ? 'text-orange-500 fill-current' : 'text-zinc-200 fill-none' }} group-hover:scale-110 transition-all duration-300" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                                </svg>
                            </button>
                            @endfor
                        </div>
                    </div>

                    <!-- Comment -->
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-zinc-400 uppercase tracking-widest block px-1">Share your thoughts</label>
                        <textarea wire:model="comment" rows="4" 
                            class="w-full bg-zinc-50 border-none rounded-[2rem] p-6 text-sm text-zinc-800 focus:ring-2 focus:ring-orange-500/20 transition-all placeholder:text-zinc-400"
                            placeholder="Tell others about the food quality, service, or anything else..."></textarea>
                    </div>

                    <!-- Actions -->
                    <div class="flex gap-4 pt-2">
                        <button wire:click="$set('showModal', false)" 
                            class="flex-1 px-8 py-4 rounded-2xl font-bold text-zinc-500 hover:bg-zinc-50 transition-all">
                            Cancel
                        </button>
                        <button wire:click="submitReview" 
                            class="flex-1 px-8 py-4 bg-[#B25C18] text-white rounded-2xl font-bold shadow-lg shadow-orange-900/20 hover:scale-105 transition-all">
                            Submit
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
