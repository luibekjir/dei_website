<x-layouts::auth :title="__('Register')">
    <x-auth-session-status class="text-center" :status="session('status')" />

    @livewire('auth.register-form')

    <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400 mt-6">
        <span>{{ __('Already have an account?') }}</span>
        <flux:link :href="route('login')" wire:navigate>{{ __('Log in') }}</flux:link>
    </div>
    </div>
</x-layouts::auth>
