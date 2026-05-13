<div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
    <!-- Revenue Today -->
    <div class="bg-white p-6 rounded-[2.5rem] border border-[#F0DECB] shadow-sm hover:shadow-md transition-shadow">
        <div class="flex items-center gap-4">
            <div class="h-14 w-14 rounded-[1.25rem] bg-[#FFF7F0] border border-[#FEEBD8] flex items-center justify-center text-[#B25C18] text-2xl shadow-inner">
                💰
            </div>
            <div>
                <p class="text-[10px] uppercase tracking-[0.2em] text-[#AB7B45] font-bold mb-1">Revenue Today</p>
                <h4 class="text-2xl font-bold text-[#1D1D1B]">@currency($stats['revenue_today'])</h4>
            </div>
        </div>
    </div>

    <!-- Orders Today -->
    <div class="bg-white p-6 rounded-[2.5rem] border border-[#F0DECB] shadow-sm hover:shadow-md transition-shadow">
        <div class="flex items-center gap-4">
            <div class="h-14 w-14 rounded-[1.25rem] bg-[#FFF7F0] border border-[#FEEBD8] flex items-center justify-center text-[#B25C18] text-2xl shadow-inner">
                📦
            </div>
            <div>
                <p class="text-[10px] uppercase tracking-[0.2em] text-[#AB7B45] font-bold mb-1">Orders Today</p>
                <h4 class="text-2xl font-bold text-[#1D1D1B]">{{ $stats['orders_today'] }}</h4>
            </div>
        </div>
    </div>

    <!-- Monthly Revenue -->
    <div class="bg-white p-6 rounded-[2.5rem] border border-[#F0DECB] shadow-sm hover:shadow-md transition-shadow">
        <div class="flex items-center gap-4">
            <div class="h-14 w-14 rounded-[1.25rem] bg-[#FFF7F0] border border-[#FEEBD8] flex items-center justify-center text-[#B25C18] text-2xl shadow-inner">
                📈
            </div>
            <div>
                <p class="text-[10px] uppercase tracking-[0.2em] text-[#AB7B45] font-bold mb-1">This Month</p>
                <h4 class="text-2xl font-bold text-[#1D1D1B]">@currency($stats['revenue_month'])</h4>
            </div>
        </div>
    </div>

    <!-- Avg Order Value -->
    <div class="bg-white p-6 rounded-[2.5rem] border border-[#F0DECB] shadow-sm hover:shadow-md transition-shadow">
        <div class="flex items-center gap-4">
            <div class="h-14 w-14 rounded-[1.25rem] bg-[#FFF7F0] border border-[#FEEBD8] flex items-center justify-center text-[#B25C18] text-2xl shadow-inner">
                ⭐
            </div>
            <div>
                <p class="text-[10px] uppercase tracking-[0.2em] text-[#AB7B45] font-bold mb-1">Avg Order</p>
                <h4 class="text-2xl font-bold text-[#1D1D1B]">@currency($stats['avg_order_value'])</h4>
            </div>
        </div>
    </div>
</div>
