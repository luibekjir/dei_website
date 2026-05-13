<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    </head>
    <body class="min-h-screen bg-[#FFF8F0] antialiased">
        <div class="flex min-h-svh flex-col items-center justify-center p-6 md:p-10">
            <div class="w-full max-w-lg">
                <!-- Logo & Brand -->
                <div class="flex flex-col items-center mb-8">
                    <a href="{{ route('home') }}" class="group" wire:navigate>
                        <div class="h-16 w-16 bg-white rounded-[2rem] border-2 border-[#F0DECB] flex items-center justify-center shadow-sm group-hover:border-[#B25C18] transition-all duration-500 overflow-hidden">
                             <span class="text-3xl">🍲</span>
                        </div>
                    </a>
                    <h1 class="mt-6 text-2xl font-black text-[#1D1D1B] tracking-tight uppercase">Culinary<span class="text-[#B25C18]">Atelier</span></h1>
                    <div class="h-1 w-8 bg-[#B25C18] mt-2 rounded-full"></div>
                </div>

                <div class="bg-white rounded-[3rem] border border-[#F0DECB] p-8 md:p-12 shadow-[0_20px_50px_rgba(178,92,24,0.05)]">
                    {{ $slot }}
                </div>

                <!-- Footer Text -->
                <p class="mt-8 text-center text-[10px] font-bold uppercase tracking-[0.2em] text-[#AB7B45] opacity-50">
                    &copy; {{ date('Y') }} Culinary Atelier &bull; Indonesian Heritage
                </p>
            </div>
        </div>

        @persist('toast')
            <flux:toast.group>
                <flux:toast />
            </flux:toast.group>
        @endpersist

        @fluxScripts
    </body>
</html>
