<div x-data="{ open: false, messages: [], input: '', loading: false }" class="fixed bottom-6 right-6 z-50">
    <!-- Chat Button -->
    <button @click="open = !open" class="bg-[#B25C18] hover:bg-[#8e4913] text-white rounded-full p-4 shadow-lg hover:shadow-xl transition-all duration-300 relative group">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
        </svg>
        <span class="absolute -top-10 right-0 bg-[#1D1D1B] text-white text-xs font-bold px-3 py-1.5 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">Ask Culinary AI</span>
    </button>

    <!-- Chat Window -->
    <div x-show="open" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-10 scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 translate-y-10 scale-95"
         class="absolute bottom-20 right-0 w-[350px] sm:w-[400px] h-[500px] bg-white rounded-3xl shadow-2xl border border-[#F0DECB] flex flex-col overflow-hidden" style="display: none;">
        
        <!-- Header -->
        <div class="bg-[#FEF6ED] p-4 border-b border-[#F0DECB] flex justify-between items-center shrink-0">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-[#B25C18] flex items-center justify-center text-white text-xl">🤖</div>
                <div>
                    <h3 class="font-bold text-[#1D1D1B]">Culinary AI Assistant</h3>
                    <p class="text-[10px] text-[#AB7B45] uppercase tracking-widest font-bold">Ask for recommendations</p>
                </div>
            </div>
            <button @click="open = false" class="text-[#6F5F51] hover:text-[#1D1D1B] p-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Messages Area -->
        <div class="flex-1 p-4 overflow-y-auto space-y-4 bg-white/50" id="chatbot-messages">
            <div class="flex flex-col items-start">
                <div class="bg-[#FEF6ED] text-[#1D1D1B] text-sm px-4 py-3 rounded-2xl rounded-tl-sm border border-[#F0DECB] shadow-sm max-w-[85%]">
                    Halo! Aku asisten Culinary Atelier. Kamu lagi pengen makan apa nih? (contoh: "cari rendang", "makanan pedas di bawah 50 ribu")
                </div>
            </div>

            <template x-for="(msg, index) in messages" :key="index">
                <div class="flex flex-col" :class="msg.role === 'user' ? 'items-end' : 'items-start'">
                    <!-- Chat Bubble -->
                    <div :class="msg.role === 'user' ? 'bg-[#B25C18] text-white rounded-2xl rounded-tr-sm' : 'bg-[#FEF6ED] text-[#1D1D1B] rounded-2xl rounded-tl-sm border border-[#F0DECB]'"
                         class="text-sm px-4 py-3 shadow-sm max-w-[85%] mb-2">
                        <span x-text="msg.content"></span>
                    </div>

                    <!-- Recommended Menus (if AI response) -->
                    <template x-if="msg.role === 'ai' && msg.menus && msg.menus.length > 0">
                        <div class="w-[85%] space-y-2 mt-1 mb-2">
                            <template x-for="menu in msg.menus">
                                <a :href="menu.url" class="block bg-white border border-[#F0DECB] rounded-xl p-3 shadow-sm hover:shadow-md transition-shadow">
                                    <h4 class="font-bold text-xs text-[#1D1D1B] line-clamp-1" x-text="menu.name"></h4>
                                    <p class="text-[10px] text-[#AB7B45] truncate" x-text="menu.restaurant_name"></p>
                                    <div class="flex justify-between items-center mt-2">
                                        <span class="text-xs font-bold text-[#B25C18]" x-text="menu.price"></span>
                                        <span class="text-[10px] bg-orange-50 text-orange-600 px-1.5 py-0.5 rounded-full font-bold" x-text="'⭐ ' + parseFloat(menu.rating).toFixed(1)"></span>
                                    </div>
                                </a>
                            </template>
                        </div>
                    </template>
                </div>
            </template>
            
            <!-- Loading Indicator -->
            <div x-show="loading" class="flex flex-col items-start" style="display: none;">
                <div class="bg-[#FEF6ED] px-4 py-3 rounded-2xl rounded-tl-sm border border-[#F0DECB] flex items-center gap-1">
                    <div class="w-2 h-2 bg-[#B25C18] rounded-full animate-bounce"></div>
                    <div class="w-2 h-2 bg-[#B25C18] rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
                    <div class="w-2 h-2 bg-[#B25C18] rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                </div>
            </div>
        </div>

        <!-- Input Area -->
        <div class="p-4 bg-white border-t border-[#F0DECB] shrink-0">
            <form @submit.prevent="
                if (!input.trim() || loading) return;
                let userMsg = input;
                messages.push({ role: 'user', content: userMsg });
                input = '';
                loading = true;
                
                // Scroll to bottom
                setTimeout(() => {
                    let c = document.getElementById('chatbot-messages');
                    c.scrollTop = c.scrollHeight;
                }, 100);

                fetch('{{ route('chatbot.handle') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ message: userMsg })
                })
                .then(r => r.json())
                .then(data => {
                    messages.push({ role: 'ai', content: data.message, menus: data.menus });
                    loading = false;
                    setTimeout(() => {
                        let c = document.getElementById('chatbot-messages');
                        c.scrollTop = c.scrollHeight;
                    }, 100);
                })
                .catch(err => {
                    messages.push({ role: 'ai', content: 'Maaf, terjadi kesalahan saat menghubungi server.' });
                    loading = false;
                });
            " class="flex gap-2">
                <input x-model="input" type="text" placeholder="Tanya rekomendasi makanan..." class="flex-1 bg-[#FEF6ED] border border-[#F0DECB] rounded-xl px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#B25C18]" :disabled="loading">
                <button type="submit" class="bg-[#B25C18] text-white rounded-xl px-4 py-2 hover:bg-[#8e4913] transition-colors" :disabled="loading" :class="{'opacity-50': loading}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </form>
        </div>
    </div>
</div>
