{{-- <div class="mb-8">
    <h1 class="text-4xl font-bold text-zinc-800 mb-2">Kitchen Analytics</h1>
    <p class="text-zinc-600 text-lg">Review your culinary investment and taste</p>
</div>

<div class="grid grid-cols-3 gap-6">
    <div class="col-span-2 bg-white rounded-lg shadow-sm p-6 flex flex-col">
        <h3 class="text-lg font-semibold text-zinc-700 mb-4">Weekly Spending</h3>
        
        <div class="flex gap-6 mb-6">
            <div class="flex items-center gap-2">
                <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                <span class="text-sm text-zinc-600">Dining</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-3 h-3 bg-zinc-400 rounded-full"></div>
                <span class="text-sm text-zinc-600">Groceries</span>
            </div>
        </div>

        <div class="relative h-48 flex-1">
            <div class="h-full relative">
                <div class="absolute inset-0 flex flex-col justify-between">
                    <div class="border-t border-zinc-200"></div>
                    <div class="border-t border-zinc-200"></div>
                    <div class="border-t border-zinc-200"></div>
                    <div class="border-t border-zinc-200"></div>
                    <div class="border-t border-zinc-200"></div>
                    <div class="border-t border-zinc-200"></div>
                </div>

                <svg class="absolute inset-0 w-full h-full" viewBox="0 0 700 180" preserveAspectRatio="none">
                    <polyline
                        fill="none"
                        stroke="#ef4444"
                        stroke-width="3"
                        points="0,120 100,80 200,100 300,60 400,40 500,70 600,90 700,75"
                    />
                    <circle cx="0" cy="120" r="4" fill="#ef4444"/>
                    <circle cx="100" cy="80" r="4" fill="#ef4444"/>
                    <circle cx="200" cy="100" r="4" fill="#ef4444"/>
                    <circle cx="300" cy="60" r="4" fill="#ef4444"/>
                    <circle cx="400" cy="40" r="4" fill="#ef4444"/>
                    <circle cx="500" cy="70" r="4" fill="#ef4444"/>
                    <circle cx="600" cy="90" r="4" fill="#ef4444"/>
                    <circle cx="700" cy="75" r="4" fill="#ef4444"/>

                    <polyline
                        fill="none"
                        stroke="#9ca3af"
                        stroke-width="3"
                        points="0,140 100,130 200,110 300,120 400,100 500,115 600,105 700,125"
                    />
                    <circle cx="0" cy="140" r="4" fill="#9ca3af"/>
                    <circle cx="100" cy="130" r="4" fill="#9ca3af"/>
                    <circle cx="200" cy="110" r="4" fill="#9ca3af"/>
                    <circle cx="300" cy="120" r="4" fill="#9ca3af"/>
                    <circle cx="400" cy="100" r="4" fill="#9ca3af"/>
                    <circle cx="500" cy="115" r="4" fill="#9ca3af"/>
                    <circle cx="600" cy="105" r="4" fill="#9ca3af"/>
                    <circle cx="700" cy="125" r="4" fill="#9ca3af"/>
                </svg>
            </div>

            <div class="absolute bottom-0 left-0 right-0 flex justify-between text-xs text-zinc-500 mt-2">
                <span>Mon</span>
                <span>Tue</span>
                <span>Wed</span>
                <span>Thu</span>
                <span>Fri</span>
                <span>Sat</span>
                <span>Sun</span>
            </div>
        </div>
    </div>

    <div class="flex flex-col gap-6">
        <div class="bg-gradient-to-br from-amber-200 to-amber-700 rounded-lg shadow-sm p-6 flex-1 flex flex-col justify-center">
            <h3 class="text-sm font-semibold text-amber-900 mb-2">Total Monthly Spend</h3>
            <p class="text-2xl font-bold text-amber-950">Rp 15.360.000</p>
            <p class="text-xs text-amber-900 mt-2">+12% from last month</p>
        </div>

        <div class="bg-zinc-200/50 rounded-lg shadow-sm p-6 flex-1 flex flex-col justify-center">
            <h3 class="text-sm font-semibold text-zinc-800 mb-2">Average Meal Cost</h3>
            <p class="text-2xl font-bold text-zinc-900">Rp 277.500</p>
        </div>
    </div>
</div>

<div class="mt-12">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-zinc-800">Personalized for you</h2>
        <a href="#" class="text-sm text-orange-500 hover:text-orange-600 font-medium">View All Recommendations →</a>
    </div>

    <div class="grid grid-cols-3 gap-6">
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1569718212165-3a8278d5f624?w=400&h=400&fit=crop" alt="Mie Ayam" class="w-full aspect-square object-cover">
                <div class="absolute bottom-2 left-2 bg-amber-100 text-amber-800 text-xs font-semibold px-3 py-1 rounded-full">
                    98% match
                </div>
            </div>
            <div class="p-4">
                <h3 class="font-semibold text-zinc-800 mb-1">Mie Ayam</h3>
                <p class="text-sm text-zinc-600">Light food with good taste in salty and sweet chicken soup</p>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1603133872878-684f208fb84b?w=400&h=400&fit=crop" alt="Nasi Goreng" class="w-full aspect-square object-cover">
                <div class="absolute bottom-2 left-2 bg-amber-100 text-amber-800 text-xs font-semibold px-3 py-1 rounded-full">
                    95% match
                </div>
            </div>
            <div class="p-4">
                <h3 class="font-semibold text-zinc-800 mb-1">Nasi Goreng</h3>
                <p class="text-sm text-zinc-600">Indonesian fried rice with savory spices and aromatic flavors</p>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1604908176997-125f25cc6f3d?w=400&h=400&fit=crop" alt="Soto Ayam" class="w-full aspect-square object-cover">
                <div class="absolute bottom-2 left-2 bg-amber-100 text-amber-800 text-xs font-semibold px-3 py-1 rounded-full">
                    92% match
                </div>
            </div>
            <div class="p-4">
                <h3 class="font-semibold text-zinc-800 mb-1">Soto Ayam</h3>
                <p class="text-sm text-zinc-600">Traditional chicken soup with turmeric and aromatic herbs</p>
            </div>
        </div>
    </div>
</div>

<div class="mt-12">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-zinc-800">Saved Address</h2>
        <a href="#" class="text-sm text-orange-500 hover:text-orange-600 font-medium">Manage All</a>
    </div>

    <div class="grid grid-cols-3 gap-6">
        <div class="bg-zinc-200/50 rounded-lg p-5 relative">
            <div class="flex justify-between items-start mb-3">
                <h3 class="text-lg font-semibold text-zinc-800">Home</h3>
                <span class="bg-green-600 text-white text-xs font-medium px-3 py-1 rounded-full">Default</span>
            </div>
            <p class="text-sm text-zinc-700 mb-8">Jl. Merdeka No. 123, Kelurahan Sudirman, Kecamatan Menteng, Jakarta Pusat, DKI Jakarta 10310</p>
            <div class="absolute bottom-4 right-4 flex gap-3">
                <button class="text-zinc-600 hover:text-zinc-800">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                    </svg>
                </button>
                <button class="text-zinc-600 hover:text-zinc-800">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                </button>
            </div>
        </div>

        <div class="bg-zinc-200/50 rounded-lg p-5 relative">
            <h3 class="text-lg font-semibold text-zinc-800 mb-3">Work</h3>
            <p class="text-sm text-zinc-700 mb-8">Jl. Gatot Subroto Kav. 52-53, RT.6/RW.1, Kuningan Barat, Mampang Prapatan, Jakarta Selatan 12710</p>
            <div class="absolute bottom-4 right-4 flex gap-3">
                <button class="text-zinc-600 hover:text-zinc-800">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                    </svg>
                </button>
                <button class="text-zinc-600 hover:text-zinc-800">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                </button>
            </div>
        </div>

        <div class="bg-white rounded-lg border-4 border-dashed border-zinc-200/50 p-5 flex items-center justify-center cursor-pointer hover:border-zinc-300 transition">
            <div class="text-center">
                <div class="w-16 h-16 bg-zinc-200/50 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-8 h-8 text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </div>
                <p class="text-zinc-600 font-medium">Add New Address</p>
            </div>
        </div>
    </div>
</div>

<div class="mt-12">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-zinc-800">Activity History</h2>
        <div class="flex items-center gap-3">
            <button class="text-zinc-600 hover:text-zinc-800">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <button class="text-zinc-600 hover:text-zinc-800">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </button>
        </div>
    </div>

    <div class="space-y-4">
        <div class="bg-zinc-200/50 rounded-lg p-4 flex items-center gap-4">
            <img src="https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=80&h=80&fit=crop" alt="Koh Afung" class="w-16 h-16 rounded-lg object-cover">
            <div class="flex-1">
                <h3 class="font-semibold text-zinc-800">Koh Afung Kwetiau</h3>
                <p class="text-sm text-zinc-600">Order placed</p>
            </div>
            <div class="text-right">
                <p class="font-semibold text-zinc-800 mb-1">-Rp 18.500</p>
                <span class="bg-blue-300/50 text-blue-800 text-xs font-medium px-3 py-1 rounded-full">Delivered</span>
            </div>
        </div>

        <div class="bg-zinc-200/50 rounded-lg p-4 flex items-center gap-4">
            <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=80&h=80&fit=crop" alt="Warung Padang" class="w-16 h-16 rounded-lg object-cover">
            <div class="flex-1">
                <h3 class="font-semibold text-zinc-800">Warung Padang Sederhana</h3>
                <p class="text-sm text-zinc-600">Order placed</p>
            </div>
            <div class="text-right">
                <p class="font-semibold text-zinc-800 mb-1">-Rp 35.000</p>
                <span class="bg-amber-200/50 text-amber-800 text-xs font-medium px-3 py-1 rounded-full">Upcoming</span>
            </div>
        </div>

        <div class="bg-zinc-200/50 rounded-lg p-4 flex items-center gap-4">
            <img src="https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=80&h=80&fit=crop" alt="Pizza Place" class="w-16 h-16 rounded-lg object-cover">
            <div class="flex-1">
                <h3 class="font-semibold text-zinc-800">Pizza Hut Menteng</h3>
                <p class="text-sm text-zinc-600">Order placed</p>
            </div>
            <div class="text-right">
                <p class="font-semibold text-zinc-800 mb-1">-Rp 125.000</p>
                <span class="bg-zinc-800 text-white text-xs font-medium px-3 py-1 rounded-full">Completed</span>
            </div>
        </div>
    </div>
</div> --}}
