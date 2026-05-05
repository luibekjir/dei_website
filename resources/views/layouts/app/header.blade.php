<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-[#FFF8F0]">
    <flux:header class="flex items-center justify-between px-6 py-4 bg-[#FFF8F0] border-b border-zinc-200">

        <!-- LEFT: Logo -->
        <div class="flex items-center space-x-2">
            <span class="text-lg font-semibold text-zinc-800">
                <a href="{{ route('home') }}" class="hover:text-black transition">
                    CulinaryAtelier
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
                <a href="{{ route('profile.user') }}" class="flex items-center gap-2 group">
                    <div class="h-10 w-10 rounded-full bg-[#F5E6D3] border border-[#E3C1A5] flex items-center justify-center text-[#7A4900] font-bold group-hover:bg-[#EBDCC8] transition shadow-sm">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                </a>
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
            <flux:sidebar.group :heading="__('Platform')">
                <flux:sidebar.item icon="layout-grid" :href="route('dashboard')"
                    :current="request()->routeIs('dashboard')" wire:navigate>
                    {{ __('Dashboard') }}
                </flux:sidebar.item>
            </flux:sidebar.group>
        </flux:sidebar.nav>

        <flux:spacer />

        <flux:sidebar.nav>
            <flux:sidebar.item icon="folder-git-2" href="https://github.com/laravel/livewire-starter-kit"
                target="_blank">
                {{ __('Repository') }}
            </flux:sidebar.item>
            <flux:sidebar.item icon="book-open-text" href="https://laravel.com/docs/starter-kits#livewire"
                target="_blank">
                {{ __('Documentation') }}
            </flux:sidebar.item>
        </flux:sidebar.nav>
    </flux:sidebar>

    {{ $slot }}

    @persist('toast')
        <flux:toast.group>
            <flux:toast />
        </flux:toast.group>
    @endpersist

    @fluxScripts
</body>

</html>
