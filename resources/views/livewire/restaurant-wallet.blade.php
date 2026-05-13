<div class="p-8 space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-700">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white/40 backdrop-blur-xl p-8 rounded-[3rem] border border-white/60 shadow-sm">
        <div>
            <h2 class="text-3xl font-black text-[#1D1D1B] tracking-tight">Restaurant Wallet</h2>
            <p class="text-sm text-zinc-500 font-medium">Manage your earnings and withdrawal requests</p>
        </div>
        <div class="bg-gradient-to-br from-[#1D1D1B] to-[#3D3D3B] p-8 rounded-[2.5rem] shadow-xl min-w-[280px] relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -mr-16 -mt-16 blur-2xl group-hover:bg-white/10 transition-all duration-700"></div>
            <p class="text-[10px] font-bold text-white/40 uppercase tracking-[0.3em] mb-1">Available Balance</p>
            <h3 class="text-4xl font-black text-white tracking-tighter">@currency($restaurant->balance ?? 0)</h3>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Bank Info Section -->
        <div class="lg:col-span-1 space-y-8">
            <div class="bg-white/60 backdrop-blur-md p-8 rounded-[3rem] border border-white/80 shadow-sm space-y-6">
                <div class="flex items-center gap-3 mb-2">
                    <div class="p-2 bg-[#FFF7F0] rounded-xl text-[#B25C18]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                    </div>
                    <h3 class="text-sm font-bold text-[#1D1D1B] uppercase tracking-widest">Bank Account</h3>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-[10px] font-bold text-zinc-400 uppercase tracking-widest mb-2 px-1">Bank Name</label>
                        <input type="text" wire:model="bank_name" placeholder="e.g. Bank Central Asia (BCA)" 
                            class="w-full bg-white/50 border-white/20 rounded-2xl p-4 text-sm font-semibold text-[#1D1D1B] focus:ring-2 focus:ring-[#B25C18]/20 focus:border-[#B25C18] transition-all">
                        @error('bank_name') <span class="text-[9px] text-red-500 font-bold mt-1 ml-1">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-zinc-400 uppercase tracking-widest mb-2 px-1">Account Number</label>
                        <input type="text" wire:model="bank_account_number" placeholder="Enter account number" 
                            class="w-full bg-white/50 border-white/20 rounded-2xl p-4 text-sm font-semibold text-[#1D1D1B] focus:ring-2 focus:ring-[#B25C18]/20 focus:border-[#B25C18] transition-all">
                        @error('bank_account_number') <span class="text-[9px] text-red-500 font-bold mt-1 ml-1">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-zinc-400 uppercase tracking-widest mb-2 px-1">Account Holder Name</label>
                        <input type="text" wire:model="bank_account_name" placeholder="Enter holder name" 
                            class="w-full bg-white/50 border-white/20 rounded-2xl p-4 text-sm font-semibold text-[#1D1D1B] focus:ring-2 focus:ring-[#B25C18]/20 focus:border-[#B25C18] transition-all">
                        @error('bank_account_name') <span class="text-[9px] text-red-500 font-bold mt-1 ml-1">{{ $message }}</span> @enderror
                    </div>
                    <button wire:click="updateBankInfo" class="w-full bg-white text-[#1D1D1B] py-4 rounded-2xl font-bold uppercase tracking-widest text-[10px] border border-zinc-100 shadow-sm hover:shadow-md active:scale-95 transition-all">
                        Update Bank Info
                    </button>
                </div>
            </div>

            <!-- Withdrawal Form -->
            <div class="bg-[#FFF7F0]/60 backdrop-blur-md p-8 rounded-[3rem] border border-[#FEEBD8] shadow-sm space-y-6">
                <div class="flex items-center gap-3 mb-2">
                    <div class="p-2 bg-white rounded-xl text-[#B25C18]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-sm font-bold text-[#1D1D1B] uppercase tracking-widest">Withdraw Funds</h3>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-[10px] font-bold text-[#B25C18] uppercase tracking-widest mb-2 px-1">Amount to Withdraw</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm font-bold text-zinc-400">Rp</span>
                            <input type="number" wire:model="withdrawal_amount" placeholder="0" 
                                class="w-full bg-white border-[#FEEBD8] rounded-2xl p-4 pl-12 text-sm font-black text-[#1D1D1B] focus:ring-2 focus:ring-[#B25C18]/20 focus:border-[#B25C18] transition-all">
                        </div>
                        @error('withdrawal_amount') <span class="text-[10px] text-red-500 font-bold mt-1 ml-1">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-[#B25C18] uppercase tracking-widest mb-2 px-1">Notes (Optional)</label>
                        <textarea wire:model="notes" rows="2" class="w-full bg-white border-[#FEEBD8] rounded-2xl p-4 text-sm font-medium text-[#1D1D1B] focus:ring-2 focus:ring-[#B25C18]/20 focus:border-[#B25C18] transition-all"></textarea>
                    </div>
                    <button wire:click="requestWithdrawal" 
                        class="w-full bg-[#1D1D1B] text-white py-5 rounded-[2rem] font-black uppercase tracking-[0.2em] shadow-xl hover:scale-[1.02] active:scale-95 transition-all text-xs">
                        Request Payout
                    </button>
                    <p class="text-[9px] text-zinc-400 text-center font-medium">Processing time typically takes 1-3 business days.</p>
                </div>
            </div>
        </div>

        <!-- History Section -->
        <div class="lg:col-span-2">
            <div class="bg-white/60 backdrop-blur-md p-10 rounded-[3.5rem] border border-white/80 shadow-sm min-h-[600px]">
                <div class="flex items-center justify-between mb-10">
                    <div class="space-y-1">
                        <h3 class="text-sm font-black text-[#1D1D1B] uppercase tracking-[0.3em]">Withdrawal History</h3>
                        <button wire:click="simulatePayoutSuccess" class="text-[8px] font-bold text-amber-600 uppercase tracking-tighter hover:text-amber-700 transition-colors flex items-center gap-1">
                            <span>⚡ Dev Tool: Simulate Payout Success</span>
                        </button>
                    </div>
                    <div class="flex gap-2">
                        <span class="px-3 py-1 bg-zinc-100 rounded-full text-[9px] font-bold text-zinc-500 uppercase tracking-tighter">{{ $withdrawals->count() }} Records</span>
                    </div>
                </div>

                @if($withdrawals->isEmpty())
                    <div class="flex flex-col items-center justify-center py-32 opacity-20">
                        <svg class="w-16 h-16 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <p class="font-bold uppercase tracking-widest text-xs">No withdrawal history yet</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="text-left border-b border-zinc-100">
                                    <th class="pb-6 text-[10px] font-bold text-zinc-400 uppercase tracking-widest">Date</th>
                                    <th class="pb-6 text-[10px] font-bold text-zinc-400 uppercase tracking-widest">Amount</th>
                                    <th class="pb-6 text-[10px] font-bold text-zinc-400 uppercase tracking-widest text-center">Status</th>
                                    <th class="pb-6 text-[10px] font-bold text-zinc-400 uppercase tracking-widest">Reference</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-zinc-50">
                                @foreach($withdrawals as $withdrawal)
                                    <tr class="group hover:bg-white/40 transition-colors">
                                        <td class="py-6">
                                            <p class="text-sm font-bold text-[#1D1D1B]">{{ $withdrawal->created_at->format('d M Y') }}</p>
                                            <p class="text-[9px] text-zinc-400 font-medium tracking-tight">{{ $withdrawal->created_at->format('H:i') }}</p>
                                        </td>
                                        <td class="py-6">
                                            <p class="text-sm font-black text-[#1D1D1B]">@currency($withdrawal->amount)</p>
                                        </td>
                                        <td class="py-6 flex justify-center">
                                            @php
                                                $statusClasses = [
                                                    'pending' => 'bg-amber-100 text-amber-600',
                                                    'approved' => 'bg-blue-100 text-blue-600',
                                                    'paid' => 'bg-green-100 text-green-600',
                                                    'rejected' => 'bg-red-100 text-red-600',
                                                ];
                                            @endphp
                                            <span class="px-4 py-1.5 rounded-full text-[9px] font-black uppercase tracking-widest {{ $statusClasses[$withdrawal->status] }}">
                                                {{ $withdrawal->status }}
                                            </span>
                                        </td>
                                        <td class="py-6">
                                            <p class="text-[10px] font-mono text-zinc-400 group-hover:text-zinc-600 transition-colors">
                                                {{ $withdrawal->reference_number ?? '—' }}
                                            </p>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
