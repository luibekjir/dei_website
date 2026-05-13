<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h3 class="text-lg font-bold text-[#1D1D1B]">Flexible Delivery Fees</h3>
        <button wire:click="createRule" class="rounded-full bg-[#B25C18] px-4 py-2 text-xs font-bold text-white transition hover:bg-[#8F4C11]">
            + Add New Rule
        </button>
    </div>

    @if($showForm)
    <div class="rounded-3xl border border-[#F0DECB] bg-[#FFF7F0] p-6 shadow-sm animate-in fade-in slide-in-from-top-2">
        <h4 class="text-sm font-bold uppercase tracking-wider text-[#AB7B45] mb-4">{{ $editingRuleId ? 'Edit Rule' : 'New Delivery Rule' }}</h4>
        <div class="grid gap-4 sm:grid-cols-2">
            <div class="space-y-1.5">
                <label class="text-[10px] font-bold uppercase tracking-wider text-[#AB7B45] ml-1">Rule Type</label>
                <select wire:model.live="type" class="w-full bg-white border border-[#F0DECB] rounded-xl px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-[#B25C18]">
                    <option value="fixed">Fixed Fee</option>
                    <option value="free_items">Free Delivery (Min Items)</option>
                    <option value="discount_items">Discount (Min Items)</option>
                    <option value="free_purchase">Free Delivery (Min Purchase)</option>
                </select>
            </div>

            @if($type === 'fixed')
            <div class="space-y-1.5">
                <label class="text-[10px] font-bold uppercase tracking-wider text-[#AB7B45] ml-1">Fixed Fee (Rp)</label>
                <input type="number" wire:model="fixed_fee" class="w-full bg-white border border-[#F0DECB] rounded-xl px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-[#B25C18]">
            </div>
            @endif

            @if($type === 'free_items' || $type === 'discount_items')
            <div class="space-y-1.5">
                <label class="text-[10px] font-bold uppercase tracking-wider text-[#AB7B45] ml-1">Minimum Items</label>
                <input type="number" wire:model="min_items" class="w-full bg-white border border-[#F0DECB] rounded-xl px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-[#B25C18]">
            </div>
            @endif

            @if($type === 'discount_items')
            <div class="space-y-1.5">
                <label class="text-[10px] font-bold uppercase tracking-wider text-[#AB7B45] ml-1">Discount (%)</label>
                <input type="number" wire:model="discount_percentage" class="w-full bg-white border border-[#F0DECB] rounded-xl px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-[#B25C18]">
            </div>
            @endif

            @if($type === 'free_purchase')
            <div class="space-y-1.5">
                <label class="text-[10px] font-bold uppercase tracking-wider text-[#AB7B45] ml-1">Min Purchase (Rp)</label>
                <input type="number" wire:model="min_purchase" class="w-full bg-white border border-[#F0DECB] rounded-xl px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-[#B25C18]">
            </div>
            @endif
        </div>

        <div class="mt-6 flex gap-3">
            <button wire:click="saveRule" class="rounded-xl bg-[#B25C18] px-6 py-3 text-sm font-bold text-white transition hover:bg-[#8F4C11]">
                Save Rule
            </button>
            <button wire:click="$set('showForm', false)" class="rounded-xl bg-white border border-[#F0DECB] px-6 py-3 text-sm font-bold text-[#6F5F51] transition hover:bg-zinc-50">
                Cancel
            </button>
        </div>
    </div>
    @endif

    <div class="space-y-3">
        @foreach($rules as $rule)
        <div class="flex items-center justify-between rounded-[1.5rem] border border-[#F0DECB] bg-white p-5 shadow-sm transition hover:shadow-md">
            <div class="flex items-center gap-4">
                <div @class([
                    'h-10 w-10 rounded-full flex items-center justify-center text-lg',
                    'bg-green-50 text-green-600' => $rule->is_active,
                    'bg-zinc-50 text-zinc-400' => !$rule->is_active
                ])>
                    @if($rule->type === 'fixed') 💰 @elseif($rule->type === 'free_items') 📦 @elseif($rule->type === 'discount_items') 🏷️ @else 💎 @endif
                </div>
                <div>
                    <p class="text-sm font-bold text-[#1D1D1B]">
                        @if($rule->type === 'fixed')
                            Fixed Fee: @currency($rule->fixed_fee)
                        @elseif($rule->type === 'free_items')
                            Free Delivery for {{ $rule->min_items }}+ items
                        @elseif($rule->type === 'discount_items')
                            {{ $rule->discount_percentage }}% Off for {{ $rule->min_items }}+ items
                        @elseif($rule->type === 'free_purchase')
                            Free for @currency($rule->min_purchase)+ purchase
                        @endif
                    </p>
                    <p class="text-[10px] uppercase tracking-wider text-[#AB7B45] mt-0.5">
                        {{ $rule->is_active ? 'Currently Active' : 'Deactivated' }}
                    </p>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <button wire:click="toggleRule({{ $rule->id }})" class="p-2 text-[#AB7B45] hover:bg-orange-50 rounded-lg transition-colors">
                    @if($rule->is_active) ⏸️ @else ▶️ @endif
                </button>
                <button wire:click="editRule({{ $rule->id }})" class="p-2 text-[#AB7B45] hover:bg-orange-50 rounded-lg transition-colors">
                    ✏️
                </button>
                <button wire:click="deleteRule({{ $rule->id }})" class="p-2 text-red-400 hover:bg-red-50 rounded-lg transition-colors">
                    🗑️
                </button>
            </div>
        </div>
        @endforeach

        @if($rules->isEmpty())
        <div class="py-10 text-center space-y-4 rounded-[2rem] border-2 border-dashed border-[#F0DECB]">
            <span class="text-4xl">🚚</span>
            <p class="text-sm text-[#6F5F51]">No delivery rules configured yet.</p>
        </div>
        @endif
    </div>
</div>
