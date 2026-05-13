<div>
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-[#F0DECB] overflow-hidden">
        <!-- Tabs -->
        <div class="flex border-b border-[#F1D9C6] bg-[#FFF7F0]">
            @foreach(['active' => 'Active', 'pickup' => 'Pickup', 'delivery' => 'Delivery', 'history' => 'History'] as $key => $label)
                <button wire:click="setFilter('{{ $key }}')" 
                    class="flex-1 px-6 py-4 text-sm font-bold transition-all {{ $filter === $key ? 'text-[#B25C18] border-b-4 border-[#B25C18] bg-white shadow-sm' : 'text-[#6B5A4A] hover:bg-[#FCE9D9]' }}">
                    {{ $label }}
                </button>
            @endforeach
        </div>

        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-[10px] uppercase tracking-[0.2em] text-[#AB7B45] border-b border-[#F1D9C6]">
                            <th class="pb-4 px-2">Order #</th>
                            <th class="pb-4 px-2">Items</th>
                            <th class="pb-4 px-2">Total</th>
                            <th class="pb-4 px-2">Status</th>
                            <th class="pb-4 px-2 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#F5E6D3]">
                        @forelse($orders as $order)
                            <tr class="text-sm group hover:bg-[#FFFAF5] transition-colors">
                                <td class="py-5 px-2 font-bold text-[#1D1D1B]">#{{ $order->id }}</td>
                                <td class="py-5 px-2">
                                    @if(is_array($order->items))
                                        <div class="flex flex-wrap gap-1">
                                            @foreach($order->items as $item)
                                                <span class="inline-block bg-[#FDF2E9] border border-[#F5E6D3] px-2 py-0.5 rounded-md text-[11px] text-[#6D3C0F] font-medium">
                                                    {{ $item['name'] }} <span class="text-[#B25C18]">x{{ $item['quantity'] }}</span>
                                                </span>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="text-xs italic text-gray-400">No items listed</span>
                                    @endif
                                </td>
                                <td class="py-5 px-2 font-bold text-[#B25C18]">@currency($order->total)</td>
                                <td class="py-5 px-2">
                                    <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider
                                        {{ in_array($order->status, ['completed', 'delivered']) ? 'bg-green-100 text-green-700' : 'bg-orange-100 text-[#B25C18]' }}">
                                        {{ str_replace('_', ' ', $order->status) }}
                                    </span>
                                </td>
                                <td class="py-5 px-2 text-right">
                                    <div class="relative inline-block text-left" x-data="{ open: false }">
                                        <button @click="open = !open" class="inline-flex items-center gap-1 bg-[#FEF6ED] border border-[#E9D6C3] px-3 py-1.5 rounded-full text-[#B25C18] font-bold text-[10px] hover:bg-[#F8E5D6] transition-colors">
                                            Update Status 
                                            <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                        </button>
                                        <div x-show="open" 
                                             x-transition:enter="transition ease-out duration-100"
                                             x-transition:enter-start="opacity-0 scale-95"
                                             x-transition:enter-end="opacity-100 scale-100"
                                             @click.away="open = false" 
                                             class="absolute right-0 mt-2 w-48 bg-white border border-[#E9D6C3] rounded-2xl shadow-xl z-20 overflow-hidden"
                                             style="display: none;">
                                            @foreach(['preparing', 'ready_for_pickup', 'on_delivery', 'delivered', 'completed'] as $status)
                                                <button wire:click="updateStatus({{ $order->id }}, '{{ $status }}')" @click="open = false"
                                                    class="block w-full text-left px-4 py-3 text-[11px] font-medium hover:bg-[#FFF7F0] text-[#6B5A4A] transition-colors {{ $order->status === $status ? 'bg-[#FFF7F0] text-[#B25C18] font-bold' : '' }}">
                                                    {{ str_replace('_', ' ', ucfirst($status)) }}
                                                </button>
                                            @endforeach
                                        </div>
                                    </div>
                                    <button @click="$dispatch('open-chat', { orderId: {{ $order->id }}, userType: 'restaurant' })" class="inline-flex items-center gap-1 bg-[#B25C18] text-white px-3 py-1.5 rounded-full font-bold text-[10px] hover:bg-[#9A4F16] transition-colors ml-2 shadow-sm">
                                        Chat
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-16 text-center">
                                    <div class="flex flex-col items-center">
                                        <span class="text-4xl mb-4 opacity-30">📋</span>
                                        <p class="text-gray-400 font-medium italic">No orders found in this category.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
