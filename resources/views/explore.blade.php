<x-layouts::app :title="__('Explore Culinary Treasures')">
    <div class="min-h-screen bg-[#FEF6ED] text-[#1A1A1A] py-12">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            
            <header class="text-center space-y-4 mb-16">
                <p class="text-[10px] uppercase tracking-[0.4em] text-[#AB7B45] font-bold">Curated Heritage • Modern Flavors</p>
                <h1 class="text-5xl font-bold tracking-tight text-[#1D1D1B] sm:text-7xl">Explore Indonesian <br/><span class="text-[#B25C18]">Regional Delicacies</span></h1>
                <p class="max-w-2xl mx-auto text-lg text-[#6F5F51] mt-6">From the spicy Rendang of Sumatra to the rich Rawon of East Java, discover the soul of Indonesia through its culinary masterpieces.</p>
            </header>

            <!-- Map View -->
            <section class="mb-16 rounded-[2.5rem] overflow-hidden border border-[#F0DECB] shadow-sm bg-white">
                <div id="map" class="h-[300px] md:h-[400px] w-full z-0"></div>
            </section>

            @if(auth()->check() && $recommendations->count() > 0)
            <section class="mb-16">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h2 class="text-3xl font-bold text-[#1D1D1B]">Heritage for You</h2>
                        <p class="text-sm text-[#6F5F51] mt-1">Based on your hometown culinary origin</p>
                    </div>
                    <div class="h-px flex-1 bg-[#F0DECB] mx-8 hidden md:block"></div>
                    <span class="text-2xl">🏠</span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($recommendations as $menu)
                    <a href="{{ route('restaurant.show', [$menu->restaurant_id, 'highlight' => $menu->id]) }}" class="group relative overflow-hidden rounded-[2rem] bg-white border border-[#F0DECB] shadow-sm hover:shadow-xl transition-all duration-500">
                        <div class="h-48 overflow-hidden relative">
                            @if($menu->image)
                                <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" class="h-full w-full object-cover group-hover:scale-110 transition-transform duration-700" />
                            @else
                                <div class="h-full w-full flex items-center justify-center bg-[#F4E6D9] text-[#AB7B45] font-bold text-4xl">{{ $menu->name[0] }}</div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            <div class="absolute bottom-4 left-4 right-4 translate-y-4 group-hover:translate-y-0 transition-transform text-white opacity-0 group-hover:opacity-100">
                                <p class="text-[10px] font-bold uppercase tracking-widest">Recommended Origin</p>
                                <p class="text-sm font-bold truncate">{{ $menu->city?->name }}</p>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="font-bold text-[#1D1D1B] truncate">{{ $menu->name }}</h3>
                            <div class="flex items-center justify-between mt-3">
                                <span class="text-sm font-bold text-[#B25C18]">@currency($menu->price)</span>
                                <span class="text-[10px] bg-orange-50 text-orange-600 px-2 py-1 rounded-full font-bold">⭐ {{ number_format($menu->rating, 1) }}</span>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </section>
            @endif

            <div x-data="{ mobileFiltersOpen: false }" class="flex flex-col lg:flex-row gap-12">
                <!-- Mobile Filter Toggle -->
                <div class="lg:hidden">
                    <button @click="mobileFiltersOpen = !mobileFiltersOpen" class="w-full flex items-center justify-between bg-white border border-[#F0DECB] rounded-2xl px-6 py-4 text-sm font-bold text-[#AB7B45] shadow-sm">
                        <span class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                            Filter Heritage Selection
                        </span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform" :class="{ 'rotate-180': mobileFiltersOpen }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                </div>

                <!-- Filters Sidebar -->
                <aside 
                    :class="mobileFiltersOpen ? 'block' : 'hidden lg:block'"
                    class="w-full lg:w-[300px] shrink-0 space-y-10"
                >
                    <section>
                        <h2 class="text-sm font-bold uppercase tracking-widest text-[#AB7B45] mb-6">Filter by Region</h2>
                        <livewire:region-filter />
                    </section>
                    
                    <form action="{{ route('explore') }}" method="GET" class="space-y-10">
                        <section>
                            <h2 class="text-sm font-bold uppercase tracking-widest text-[#AB7B45] mb-6">Search</h2>
                            <div class="relative">
                                <input 
                                    type="text" 
                                    name="search" 
                                    value="{{ request('search') }}"
                                    placeholder="Search dishes or restaurants..."
                                    class="w-full bg-white border border-[#F0DECB] rounded-2xl px-5 py-4 text-sm focus:ring-2 focus:ring-[#B25C18] focus:border-transparent shadow-sm outline-none transition-all"
                                >
                                <button type="submit" class="absolute right-4 top-1/2 -translate-y-1/2 text-[#AB7B45]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </button>
                            </div>
                        </section>

                        <section>
                            <h2 class="text-sm font-bold uppercase tracking-widest text-[#AB7B45] mb-6">Budget Range</h2>
                            <div class="space-y-4 px-2">
                                <input 
                                    type="range" 
                                    name="budget" 
                                    min="1" 
                                    max="4" 
                                    step="1" 
                                    value="{{ request('budget', 1) }}" 
                                    class="w-full h-2 bg-[#F0DECB] rounded-lg appearance-none cursor-pointer accent-[#B25C18]"
                                    onchange="this.form.submit()"
                                    oninput="document.getElementById('budgetValue').innerText = ['< Rp 30rb', 'Rp 30rb - 50rb', 'Rp 50rb - 100rb', '> Rp 100rb'][this.value - 1]"
                                >
                                <div class="flex justify-between items-center">
                                    <span id="budgetValue" class="text-xs font-bold text-[#B25C18] bg-orange-50 px-3 py-1 rounded-full uppercase tracking-widest">
                                        {{ ['< Rp 30rb', 'Rp 30rb - 50rb', 'Rp 50rb - 100rb', '> Rp 100rb'][(request('budget', 1)) - 1] }}
                                    </span>
                                    <span class="text-[10px] font-bold text-[#AB7B45] uppercase tracking-widest opacity-50">Drag to filter</span>
                                </div>
                            </div>
                        </section>

                        <button type="reset" onclick="window.location='{{ route('explore') }}'" class="text-xs font-bold text-[#AB7B45] uppercase tracking-widest hover:text-[#B25C18] transition-colors">
                            Clear all filters
                        </button>
                    </form>
                </aside>

                <!-- Results Grid -->
                <main class="flex-1 space-y-8 min-w-0">
                    <div class="flex items-center justify-between">
                        <p class="text-sm text-[#6F5F51] font-medium">Showing <span class="text-[#1D1D1B] font-bold">{{ count($menus) }}</span> curated treasures</p>
                        <div class="flex items-center gap-2 text-xs font-bold text-[#AB7B45] uppercase tracking-wider">
                            <span>Sort by:</span>
                            <select class="bg-transparent border-none focus:ring-0 cursor-pointer text-[#B25C18]">
                                <option>Recommended</option>
                                <option>Newest</option>
                                <option>Rating</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                        @forelse($menus as $menu)
                        <a href="{{ route('restaurant.show', [$menu->restaurant->id, 'highlight' => $menu->id]) }}" class="group">
                            <article class="h-full flex flex-col bg-white rounded-[2.5rem] border border-[#F0DECB] overflow-hidden shadow-sm hover:shadow-[0_20px_50px_rgba(194,107,23,0.15)] transition-all duration-500 hover:-translate-y-2">
                                <div class="h-64 overflow-hidden relative">
                                    @if($menu->image)
                                        <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-[#F4E6D9] text-[#AB7B45]">
                                            <span class="font-bold text-lg uppercase tracking-tighter">{{ $menu->name[0] }}</span>
                                        </div>
                                    @endif
                                    <div class="absolute top-4 right-4 bg-white/90 backdrop-blur px-3 py-1.5 rounded-2xl text-xs font-bold text-[#B25C18] shadow-sm flex items-center gap-1.5">
                                        ⭐ {{ number_format($menu->rating, 1) }}
                                    </div>
                                    @if($menu->is_halal)
                                        <div class="absolute top-4 left-4 bg-green-600/90 backdrop-blur px-3 py-1.5 rounded-2xl text-[10px] font-bold text-white shadow-sm uppercase tracking-wider">
                                            Halal
                                        </div>
                                    @endif
                                </div>

                                <div class="p-8 flex-1 flex flex-col space-y-4">
                                    <div class="flex justify-between items-start">
                                        <p class="text-[10px] uppercase tracking-[0.2em] text-[#AB7B45] font-bold">{{ $menu->city?->name ?? 'Regional' }}</p>
                                        <p class="text-lg font-bold text-[#B25C18]">@currency($menu->price)</p>
                                    </div>

                                    <h3 class="text-2xl font-bold text-[#1D1D1B] leading-tight group-hover:text-[#B25C18] transition-colors">
                                        {{ $menu->name }}
                                    </h3>

                                    <p class="text-[#6F5F51] text-sm leading-relaxed line-clamp-2 flex-1">
                                        {{ $menu->description }}
                                    </p>

                                    <div class="pt-6 border-t border-[#F0DECB] flex items-center justify-between">
                                        <div class="flex items-center gap-3 min-w-0">
                                            <div class="w-8 h-8 rounded-full bg-[#F4E6D9] flex-shrink-0 flex items-center justify-center text-[#AB7B45] text-[10px] font-bold">
                                                {{ $menu->restaurant->name[0] }}
                                            </div>
                                            <div class="min-w-0">
                                                <p class="text-xs font-bold text-[#1D1D1B] truncate">{{ $menu->restaurant->name }}</p>
                                                <p class="text-[10px] text-[#AB7B45] truncate uppercase tracking-tighter">{{ $menu->restaurant->category->name }}</p>
                                            </div>
                                        </div>
                                        <span class="text-lg grayscale group-hover:grayscale-0 transition-all">🍽️</span>
                                    </div>
                                </div>
                            </article>
                        </a>
                        @empty
                        <div class="col-span-full py-20 text-center space-y-6 bg-white rounded-[3rem] border-2 border-dashed border-[#F0DECB]">
                            <span class="text-6xl">🥘</span>
                            <div>
                                <h3 class="text-xl font-bold text-[#1D1D1B]">No treasures found</h3>
                                <p class="text-[#6F5F51] mt-2">Try adjusting your filters to discover other regions.</p>
                            </div>
                        </div>
                        @endforelse
                    </div>
                </main>
            </div>
        </div>
    </div>

    <!-- Map Scripts & Styles -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof L === 'undefined') {
            return;
        }

        // Initialize map centered on Universitas Ciputra Surabaya
        const map = L.map('map').setView([-7.2858, 112.6313], 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        let userLocation = null;
        let routeLine = null;
        const markerGroup = L.featureGroup().addTo(map);
        
        const menus = @json($menus);

        const restaurantIcon = L.divIcon({
            html: '<div style="background-color: #B25C18; width: 14px; height: 14px; border-radius: 50%; border: 2px solid white; box-shadow: 0 0 6px rgba(178,92,24,0.4);"></div>',
            className: 'custom-div-icon',
            iconSize: [14, 14],
            iconAnchor: [7, 7]
        });

        const userIcon = L.divIcon({
            html: `
                <div style="position: relative; display: flex; align-items: center; justify-content: center;">
                    <div style="position: absolute; width: 30px; height: 30px; background-color: rgba(37, 99, 235, 0.3); border-radius: 50%; animation: pulse-blue 2s infinite;"></div>
                    <div style="position: relative; width: 14px; height: 14px; background-color: #2563eb; border: 2px solid white; border-radius: 50%; box-shadow: 0 0 8px rgba(0,0,0,0.3);"></div>
                </div>
                <style>
                    @keyframes pulse-blue {
                        0% { transform: scale(0.95); opacity: 0.7; }
                        70% { transform: scale(1.5); opacity: 0; }
                        100% { transform: scale(0.95); opacity: 0; }
                    }
                </style>
            `,
            className: 'user-location-icon',
            iconSize: [30, 30],
            iconAnchor: [15, 15]
        });

        const userAddress = @json($userAddress);

        // 1. Initial Marker Placement for Restaurants
        menus.forEach(menu => {
            const restaurant = menu.restaurant;
            if (restaurant.latitude && restaurant.longitude) {
                menu.lat = parseFloat(restaurant.latitude);
                menu.lng = parseFloat(restaurant.longitude);
                addMenuMarker(menu);
            }
        });

        if (markerGroup.getLayers().length > 0) {
            map.fitBounds(markerGroup.getBounds(), { padding: [50, 50] });
        }

        // 2. Add User Location (Priority: Address > Geolocation)
        if (userAddress && userAddress.latitude && userAddress.longitude) {
            userLocation = [parseFloat(userAddress.latitude), parseFloat(userAddress.longitude)];
            addUserMarker(userLocation, userAddress.label || 'Your Address', 'Saved Address');
        } else if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(position => {
                userLocation = [position.coords.latitude, position.coords.longitude];
                addUserMarker(userLocation, 'You are here', 'Current Location');
            }, error => {
                console.warn('Geolocation failed:', error.message);
                // Final fallback center
                userLocation = [-7.2858, 112.6313];
                addUserMarker(userLocation, 'Universitas Ciputra', 'Discovery Point');
            });
        }

        function addUserMarker(loc, title, subtitle) {
            L.marker(loc, { icon: userIcon, zIndexOffset: 1000 }).addTo(map)
                .bindPopup(`<div class="p-2"><b class="text-blue-600">${title}</b><p class="text-[10px] text-zinc-500 mt-1 uppercase tracking-widest font-bold">${subtitle}</p></div>`);
            
            // Re-adjust bounds to include user
            const bounds = markerGroup.getBounds();
            if (bounds.isValid()) {
                bounds.extend(loc);
                map.fitBounds(bounds, { padding: [50, 50] });
            } else {
                map.setView(loc, 15);
            }

            // Fallback for restaurants without coordinates: randomize near user
            menus.forEach(menu => {
                if (!menu.lat) {
                    const restaurant = menu.restaurant;
                    menu.lat = loc[0] + (Math.random() - 0.5) * 0.04;
                    menu.lng = loc[1] + (Math.random() - 0.5) * 0.04;
                    addMenuMarker(menu);
                }
            });
        }

        function addMenuMarker(menu) {
            // Avoid duplicate markers if already added
            const existingMarker = markerGroup.getLayers().find(l => l.getLatLng().lat === menu.lat && l.getLatLng().lng === menu.lng);
            if (existingMarker) return;

            const marker = L.marker([menu.lat, menu.lng], { icon: restaurantIcon }).addTo(markerGroup);
            marker.bindTooltip(`<b>${menu.name}</b><br>${menu.restaurant.name}`, { direction: 'top' });
            marker.bindPopup(`
                <div class="p-2" style="min-width: 180px; font-family: 'Inter', sans-serif;">
                    <b style="font-size: 15px; color: #1D1D1B;">${menu.name}</b><br>
                    <span style="font-size: 13px; color: #B25C18; font-weight: 700;">Rp ${new Intl.NumberFormat('id-ID').format(menu.price)}</span><br>
                    <span style="font-size: 11px; color: #6F5F51;">${menu.restaurant.name}</span><br>
                    <div class="mt-3 pt-3 border-t border-[#F0DECB]">
                        <a href="/restaurant/${menu.restaurant.id}?highlight=${menu.id}" style="color: #B25C18; font-weight: 700; text-decoration: none; font-size: 11px; display: block;">Lihat Detail Menu →</a>
                    </div>
                </div>
            `);
            
            marker.on('click', function() {
                if (userLocation) drawRoute(menu.lat, menu.lng);
            });
        }

        function drawRoute(destLat, destLng) {
            if (routeLine) map.removeLayer(routeLine);
            const start = `${userLocation[1]},${userLocation[0]}`;
            const end = `${destLng},${destLat}`;
            fetch(`https://router.project-osrm.org/route/v1/driving/${start};${end}?overview=full&geometries=geojson`)
                .then(r => r.json())
                .then(data => {
                    if (data.routes && data.routes.length > 0) {
                        const coords = data.routes[0].geometry.coordinates;
                        routeLine = L.polyline(coords.map(c => [c[1], c[0]]), {color: '#B25C18', weight: 6, opacity: 0.8}).addTo(map);
                    }
                });
        }
    });
    </script>
</x-layouts::app>
