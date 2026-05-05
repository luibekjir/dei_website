<x-layouts::app :title="__('Explore')">
    <div class="min-h-screen bg-[#F8F3EC] text-[#1F1F1F]">
        <div class="flex">

            <!-- Sidebar -->
            <aside class="w-[280px] min-h-screen bg-white border-r border-neutral-200 px-6 py-8">
                <h2 class="text-3xl font-bold text-[#E67E22]">Explore</h2>
                <p class="text-sm tracking-[0.2em] text-gray-500 uppercase mt-1">
                    Find Your Next Meal
                </p>

                <!-- Budget Range -->
                <div class="mt-8">
                    <h3 class="font-semibold text-lg">Budget Range</h3>
                    <div class="flex gap-2 mt-4 flex-wrap">

                        <a
                            href="{{ route('explore', array_merge(request()->query(), ['budget' => 1])) }}"
                            class="px-4 py-2 rounded-lg {{ request('budget') == 1 ? 'bg-[#F4A261] text-white font-medium' : 'bg-[#F5F1EB]' }}"
                        >
                            $
                        </a>

                        <a
                            href="{{ route('explore', array_merge(request()->query(), ['budget' => 2])) }}"
                            class="px-4 py-2 rounded-lg {{ request('budget') == 2 ? 'bg-[#F4A261] text-white font-medium' : 'bg-[#F5F1EB]' }}"
                        >
                            $$
                        </a>

                        <a
                            href="{{ route('explore', array_merge(request()->query(), ['budget' => 3])) }}"
                            class="px-4 py-2 rounded-lg {{ request('budget') == 3 ? 'bg-[#F4A261] text-white font-medium' : 'bg-[#F5F1EB]' }}"
                        >
                            $$$
                        </a>

                        <a
                            href="{{ route('explore', array_merge(request()->query(), ['budget' => 4])) }}"
                            class="px-4 py-2 rounded-lg {{ request('budget') == 4 ? 'bg-[#F4A261] text-white font-medium' : 'bg-[#F5F1EB]' }}"
                        >
                            $$$$
                        </a>

                    </div>
                </div>

                <!-- Rating -->
                <div class="mt-8">
                    <h3 class="font-semibold text-lg">Min. Rating</h3>
                    <div class="flex gap-2 mt-4 flex-wrap">

                        <a
                            href="{{ route('explore', array_merge(request()->query(), ['rating' => 4.5])) }}"
                            class="px-4 py-2 rounded-lg {{ request('rating') == 4.5 ? 'bg-[#F4A261] text-white font-medium' : 'bg-[#F5F1EB]' }}"
                        >
                            4.5+
                        </a>

                        <a
                            href="{{ route('explore', array_merge(request()->query(), ['rating' => 4.0])) }}"
                            class="px-4 py-2 rounded-lg {{ request('rating') == 4.0 ? 'bg-[#F4A261] text-white font-medium' : 'bg-[#F5F1EB]' }}"
                        >
                            4.0+
                        </a>

                        <a
                            href="{{ route('explore', array_merge(request()->query(), ['rating' => 3.5])) }}"
                            class="px-4 py-2 rounded-lg {{ request('rating') == 3.5 ? 'bg-[#F4A261] text-white font-medium' : 'bg-[#F5F1EB]' }}"
                        >
                            3.5+
                        </a>

                    </div>
                </div>

                <!-- Categories -->
                <div class="mt-8">
                    <h3 class="font-semibold text-lg">Categories</h3>
                    <div class="flex flex-wrap gap-2 mt-4">

                        @foreach($categories as $category)
                            <a
                                href="{{ route('explore', array_merge(request()->query(), ['category' => $category->id])) }}"
                                class="px-4 py-2 rounded-full text-sm
                                    {{ request('category') == $category->id
                                        ? 'bg-[#F4A261] text-white font-medium'
                                        : 'bg-[#F5E6D3]' }}"
                            >
                                {{ $category->name }}
                            </a>
                        @endforeach

                    </div>
                </div>

                <!-- Reset -->
                <a
                    href="{{ route('explore') }}"
                    class="mt-16 w-full block text-center rounded-xl bg-[#F5F1EB] py-4 font-medium"
                >
                    Reset Filters
                </a>
            </aside>

            <!-- Content Area -->
            <main class="flex-1 px-10 py-8">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h1 class="text-5xl font-bold">Curated for your palate</h1>
                        <p class="text-gray-500 mt-2">
                            Showing {{ $menus->count() }} curated menu results
                        </p>
                    </div>

                    <!-- Search Bar -->
                    <div class="w-96">
                        <form action="{{ route('explore') }}" method="GET">
                            @foreach(request()->except('search') as $key => $value)
                                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                            @endforeach
                            <input 
                                type="search" 
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Search menus, restaurants..." 
                                class="w-full px-4 py-3 text-sm border border-zinc-200 rounded-xl bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                            />
                        </form>
                    </div>
                </div>

                <!-- Map Container -->
                <!-- Map Container -->
                <div id="map" style="height: 400px; width: 100%; display: block; background: #e5e7eb; border: 1px solid #d1d5db;" class="w-full rounded-2xl mb-8 relative z-10">
                    <div class="flex items-center justify-center h-full text-gray-500 font-medium">
                        Initializing Map...
                    </div>
                </div>

                <!-- Menu Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

                    @forelse($menus as $menu)
                    <a href="{{ route('restaurant.show', $menu->restaurant->id) }}">
                        <div class="rounded-2xl overflow-hidden bg-white border border-neutral-200 shadow-sm hover:shadow-md transition-shadow h-full flex flex-col">

                            <!-- Image -->
                            <div class="h-48 bg-neutral-100 overflow-hidden relative">
                                @if($menu->image)
                                    <img
                                        src="{{ asset('storage/' . $menu->image) }}"
                                        alt="{{ $menu->name }}"
                                        class="w-full h-full object-cover"
                                    >
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-zinc-50 text-zinc-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                                <div class="absolute top-3 right-3 bg-white/90 backdrop-blur px-2 py-1 rounded-lg text-xs font-bold text-orange-600 shadow-sm">
                                    ⭐ {{ number_format($menu->rating, 1) }}
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-5 flex-1 flex flex-col">
                                <div class="flex justify-between items-start mb-2">
                                    <span class="inline-block px-2 py-0.5 text-[10px] uppercase tracking-wider font-bold rounded bg-orange-50 text-orange-700">
                                        {{ $menu->restaurant->category->name }}
                                    </span>
                                    <span class="font-bold text-zinc-900">
                                        ${{ number_format($menu->price, 2) }}
                                    </span>
                                </div>

                                <h3 class="text-xl font-bold text-zinc-800 leading-tight">
                                    {{ $menu->name }}
                                </h3>

                                <p class="text-zinc-500 mt-2 text-sm line-clamp-2 flex-1">
                                    {{ $menu->description }}
                                </p>

                                <div class="mt-4 pt-4 border-t border-zinc-100 flex items-center gap-2">
                                    <div class="w-6 h-6 rounded-full bg-zinc-200 flex-shrink-0"></div>
                                    <div class="min-w-0">
                                        <p class="text-xs font-bold text-zinc-900 truncate">{{ $menu->restaurant->name }}</p>
                                        <p class="text-[10px] text-zinc-400 truncate">{{ $menu->restaurant->address }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    @empty
                        <div class="col-span-full text-center py-20">
                            <h3 class="text-2xl font-semibold">
                                No menus found
                            </h3>
                            <p class="text-gray-500 mt-2">
                                Try adjusting your filters
                            </p>
                        </div>
                    @endforelse

                </div>
            </main>
        </div>
    </div>

    <!-- Map Scripts & Styles -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof L === 'undefined') {
            console.error('Leaflet library (L) is undefined. Check if the CDN link is working.');
            const mapContainer = document.getElementById('map');
            if (mapContainer) {
                mapContainer.innerHTML = '<div class="flex items-center justify-center h-full text-red-500">Error: Leaflet library not loaded.</div>';
            }
            return;
        }

        // Initialize map
        const map = L.map('map').setView([0, 0], 2);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        let userLocation = null;
        let routeLine = null;
        const markerGroup = L.featureGroup().addTo(map);
        
        // Load menu data from existing collection
        const menus = @json($menus);

        // Define a custom orange icon
        const restaurantIcon = L.divIcon({
            html: '<div style="background-color: #E67E22; width: 12px; height: 12px; border-radius: 50%; border: 2px solid white; box-shadow: 0 0 4px rgba(0,0,0,0.4);"></div>',
            className: 'custom-div-icon',
            iconSize: [12, 12],
            iconAnchor: [6, 6]
        });

        // Get user location
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(position => {
                userLocation = [position.coords.latitude, position.coords.longitude];
                
                // Add user marker
                const userMarker = L.marker(userLocation).addTo(map)
                    .bindPopup('<b>You are here</b>');
                
                // Display menu markers (based on restaurant location)
                menus.forEach(menu => {
                    const restaurant = menu.restaurant;
                    const lat = restaurant.latitude ? parseFloat(restaurant.latitude) : (userLocation[0] + (Math.random() - 0.5) * 0.04);
                    const lng = restaurant.longitude ? parseFloat(restaurant.longitude) : (userLocation[1] + (Math.random() - 0.5) * 0.04);
                    
                    menu.lat = lat;
                    menu.lng = lng;

                    addMenuMarker(menu);
                });

                // Zoom to fit user and all menus
                if (menus.length > 0) {
                    const bounds = markerGroup.getBounds();
                    bounds.extend(userLocation);
                    map.fitBounds(bounds, { padding: [50, 50] });
                } else {
                    map.setView(userLocation, 13);
                }
                
                userMarker.openPopup();

            }, error => {
                console.error("Error getting location: ", error);
                // Fallback: If geolocation fails, just show menus
                menus.forEach(menu => {
                    const restaurant = menu.restaurant;
                    if (restaurant.latitude && restaurant.longitude) {
                        menu.lat = parseFloat(restaurant.latitude);
                        menu.lng = parseFloat(restaurant.longitude);
                        addMenuMarker(menu);
                    }
                });
                if (menus.length > 0) {
                    map.fitBounds(markerGroup.getBounds(), { padding: [50, 50] });
                }
            });
        }

        function addMenuMarker(menu) {
            const marker = L.marker([menu.lat, menu.lng], { icon: restaurantIcon }).addTo(markerGroup);
            
            // Show menu name and restaurant name on hover
            marker.bindTooltip(`<b>${menu.name}</b><br>${menu.restaurant.name}`, { permanent: false, direction: 'top' });
            
            // Show details on click
            marker.bindPopup(`
                <div style="min-width: 150px;">
                    <b style="font-size: 14px;">${menu.name}</b><br>
                    <span style="font-size: 12px; color: #E67E22; font-weight: bold;">$${parseFloat(menu.price).toFixed(2)}</span><br>
                    <span style="font-size: 11px; color: #666;">at ${menu.restaurant.name}</span><br>
                    <div class="mt-2 pt-2 border-t border-zinc-100">
                        <a href="/restaurant/${menu.restaurant.id}" style="color: #E67E22; font-weight: bold; text-decoration: none; font-size: 11px;">View Menu Details →</a>
                    </div>
                </div>
            `);
            
            // Draw route on click
            marker.on('click', function() {
                if (userLocation) {
                    drawRoute(menu.lat, menu.lng);
                }
            });
        }

        function drawRoute(destLat, destLng) {
            if (routeLine) {
                map.removeLayer(routeLine);
            }

            const start = `${userLocation[1]},${userLocation[0]}`;
            const end = `${destLng},${destLat}`;
            const osrmUrl = `https://router.project-osrm.org/route/v1/driving/${start};${end}?overview=full&geometries=geojson`;

            fetch(osrmUrl)
                .then(response => response.json())
                .then(data => {
                    if (data.routes && data.routes.length > 0) {
                        const coords = data.routes[0].geometry.coordinates;
                        const latLngs = coords.map(c => [c[1], c[0]]);
                        
                        routeLine = L.polyline(latLngs, {color: '#E67E22', weight: 5}).addTo(map);
                        map.fitBounds(routeLine.getBounds(), { padding: [50, 50] });
                    }
                })
                .catch(err => console.error("Routing error:", err));
        }
    });
    </script>
</x-layouts::app>