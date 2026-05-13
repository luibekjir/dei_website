<div x-data="{ open: @entangle('showChat') }" 
     @open-chat.window="$wire.open($event.detail.orderId, $event.detail.userType)">
    @if($showChat)
    <div class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[200] flex items-center justify-center p-4">
        <div class="bg-white rounded-[3rem] w-full max-w-lg overflow-hidden shadow-2xl animate-in fade-in zoom-in duration-300 h-[80vh] flex flex-col">
            <!-- Header -->
            <div class="p-6 border-b border-zinc-100 flex justify-between items-center bg-orange-50/50">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-white border border-orange-100 flex items-center justify-center text-xl shadow-sm">
                        {{ $userType === 'user' ? '👨‍🍳' : '👤' }}
                    </div>
                    <div>
                        <h3 class="font-bold text-zinc-800">{{ $userType === 'user' ? $order->restaurant->name : $order->user->name }}</h3>
                        <p class="text-[10px] font-bold text-orange-500 uppercase tracking-widest">Order #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</p>
                    </div>
                </div>
                <button wire:click="$set('showChat', false)" class="text-zinc-400 hover:text-zinc-600 transition-colors">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Messages List -->
            <div class="flex-1 overflow-y-auto p-6 space-y-4 bg-zinc-50/30" wire:poll.3s>
                @foreach($messages as $msg)
                    @php 
                        $isMe = ($userType === 'user' && $msg->type === 'user_to_restaurant') || 
                                ($userType === 'restaurant' && $msg->type === 'restaurant_to_user');
                    @endphp
                    <div class="flex {{ $isMe ? 'justify-end' : 'justify-start' }}">
                        <div class="max-w-[80%] {{ $isMe ? 'bg-[#B25C18] text-white rounded-l-2xl rounded-tr-2xl' : 'bg-white border border-zinc-100 text-zinc-800 rounded-r-2xl rounded-tl-2xl' }} p-4 shadow-sm">
                            <p class="text-sm leading-relaxed">{{ $msg->message }}</p>
                            <p class="text-[9px] mt-2 opacity-60 font-bold uppercase tracking-widest text-right">
                                {{ $msg->created_at->format('H:i') }}
                            </p>
                        </div>
                    </div>
                @endforeach
                <div id="chat-end"></div>
            </div>

            <!-- Input Area -->
            <div class="p-6 border-t border-zinc-100 bg-white">
                <form wire:submit.prevent="sendMessage" class="flex gap-3">
                    <input type="text" wire:model="message" placeholder="Type your message..." 
                        class="flex-1 bg-zinc-50 border-zinc-200 rounded-2xl py-4 px-6 focus:ring-[#B25C18] focus:border-[#B25C18] text-sm">
                    <button type="submit" class="bg-[#B25C18] text-white px-8 py-4 rounded-2xl font-bold shadow-lg shadow-orange-900/20 hover:scale-105 active:scale-95 transition-all">
                        Send
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endif

    <script>
        document.addEventListener('livewire:initialized', () => {
            @this.on('chatOpened', () => {
                setTimeout(() => {
                    const chatEnd = document.getElementById('chat-end');
                    if (chatEnd) chatEnd.scrollIntoView({ behavior: 'smooth' });
                }, 100);
            });
            @this.on('messageSent', () => {
                setTimeout(() => {
                    const chatEnd = document.getElementById('chat-end');
                    if (chatEnd) chatEnd.scrollIntoView({ behavior: 'smooth' });
                }, 50);
            });
        });
    </script>
</div>
