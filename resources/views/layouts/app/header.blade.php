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
                CulinaryAtelier
            </span>
        </div>

        <!-- CENTER: Navigation & Search -->
        <div class="hidden md:flex items-center space-x-6 flex-1 justify-center">
            <nav class="flex items-center space-x-8 text-sm text-zinc-600">
                <a href="#" class="hover:text-black transition">
                    Explore
                </a>
                <a href="#" class="hover:text-black transition">
                    Recommendations
                </a>
            </nav>
            
            <!-- Search Bar -->
            <div class="w-96">
                <input 
                    type="search" 
                    placeholder="Search recipes, chefs, ingredients..." 
                    class="w-full px-4 py-2 text-sm border border-zinc-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                />
            </div>
        </div>

        <!-- RIGHT: Login Button -->
        <div>
            <a href="{{ route('login') }}"
                class="px-5 py-2 rounded-full bg-orange-500 text-white text-sm font-medium hover:bg-orange-600 transition">
                Login
            </a>
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
