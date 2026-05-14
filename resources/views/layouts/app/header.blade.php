<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-[#FFF8F0]">
    <flux:header class="flex items-center justify-between px-6 py-4 bg-[#FFF8F0] border-b border-zinc-200">
        <!-- LEFT: Logo & Toggle -->
        <div class="flex items-center space-x-4">
            <flux:sidebar.toggle class="md:hidden -ml-2" icon="bars-3" inset="left" />
            
            <span class="text-lg font-black text-[#1D1D1B] tracking-tight uppercase">
                <a href="{{ route('home') }}" class="hover:text-[#B25C18] transition">
                    Culinary<span class="text-[#B25C18]">Atelier</span>
                </a>
            </span>
        </div>

        <!-- CENTER: Navigation -->
        <div class="hidden md:flex items-center space-x-6 flex-1 justify-center">
            <nav class="flex items-center space-x-8 text-sm text-zinc-600">
                <a href="{{ route('explore') }}" class="hover:text-black transition {{ request()->routeIs('explore') ? 'text-black font-bold' : '' }}">
                    Explore
                </a>
            </nav>
        </div>

        <!-- RIGHT: Search and Auth -->
        <div class="flex items-center gap-3">
            <button class="hidden md:inline-flex h-10 w-10 items-center justify-center rounded-full border border-zinc-200 text-zinc-600 hover:border-zinc-300 transition">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-5 w-5"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.35-4.35"/></svg>
            </button>
            
            @auth
                <div class="flex items-center gap-4">
                    <a href="{{ route('profile.user') }}" class="flex items-center gap-2 group">
                        <div class="h-10 w-10 rounded-full bg-[#F5E6D3] border border-[#E3C1A5] flex items-center justify-center text-[#7A4900] font-bold group-hover:bg-[#EBDCC8] transition shadow-sm">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                    </a>
                    
                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button type="submit" class="text-[10px] font-bold text-[#AB7B45] uppercase tracking-widest hover:text-[#7A4900] transition-colors border border-[#F0DECB] px-3 py-2 rounded-full">
                            Logout
                        </button>
                    </form>
                </div>
            @else
                <a href="{{ route('login') }}"
                    class="px-5 py-2 rounded-full bg-[#7A4900] text-white text-sm font-medium hover:bg-[#603900] transition">
                    Login
                </a>
            @endauth
        </div>

    </flux:header>

    <!-- Mobile Menu -->
    <flux:sidebar collapsible="mobile" sticky
        class="lg:hidden border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
        <flux:sidebar.header>
            <x-app-logo :sidebar="true" href="{{ route('dashboard') }}" wire:navigate />
            <flux:sidebar.collapse
                class="in-data-flux-sidebar-on-desktop:not-in-data-flux-sidebar-collapsed-desktop:-mr-2" />
        </flux:sidebar.header>

        <flux:sidebar.nav>
            <flux:sidebar.group :heading="__('Explore')">
                <flux:sidebar.item icon="map" :href="route('explore')" :current="request()->routeIs('explore')" wire:navigate>
                    {{ __('Explore Cuisines') }}
                </flux:sidebar.item>
                <flux:sidebar.item icon="sparkles" :href="route('explore.random')" wire:navigate>
                    {{ __('Surprise Me!') }}
                </flux:sidebar.item>
            </flux:sidebar.group>

            @auth
            <flux:sidebar.group :heading="__('User')">
                <flux:sidebar.item icon="user-circle" :href="route('profile.user')" :current="request()->routeIs('profile.user')" wire:navigate>
                    {{ __('My Profile') }}
                </flux:sidebar.item>
                <flux:sidebar.item icon="shopping-bag" :href="route('order')" :current="request()->routeIs('order')" wire:navigate>
                    {{ __('My Orders') }}
                </flux:sidebar.item>
            </flux:sidebar.group>
            @endauth
        </flux:sidebar.nav>
    </flux:sidebar>

    {{ $slot }}

    @persist('toast')
        <flux:toast.group>
            <flux:toast />
        </flux:toast.group>
    @endpersist

    @livewire('chat-component')
    @livewire('review-component')
    @fluxScripts
</body>

</html>
