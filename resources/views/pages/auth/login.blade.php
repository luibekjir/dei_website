<x-layouts::auth :title="__('Log in')">
    <div class="text-black dark:text-black">

        <x-auth-header 
            :title="__('Log in to your account')" 
            :description="__('Enter your email and password below to log in')" 
        />

        <!-- Session Status -->
        <x-auth-session-status class="text-center text-black" :status="session('status')" />

        <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-6 text-black">
            @csrf

            <!-- Email Address -->
            <!-- Email Address -->
<flux:input 
    name="email" 
    label="Email address"
    class="!text-black"
    label:class="!text-black !opacity-100"
    :value="old('email')" 
    type="email" 
    required 
    autofocus
    autocomplete="email" 
    placeholder="email@example.com" 
    class="!border-2 !border-black !bg-white !opacity-100 accent-[#B25C18]"
/>

<!-- Password -->
<div class="relative">
    <flux:input 
        name="password" 
        label="Password"
        class="!text-black"
        label:class="!text-black !opacity-100"
        type="password" 
        required
        autocomplete="current-password"
        placeholder="Password"
        viewable 
        class="!border-2 !border-black !bg-white !opacity-100 accent-[#B25C18]"
    />

    @if (Route::has('password.request'))
        <flux:link 
            class="absolute top-0 text-sm end-0 !text-[#B25C18] hover:!text-[#8F4C11]"
            :href="route('password.request')"
            wire:navigate
            :accent="false"
        >
            {{ __('Forgot password?') }}
        </flux:link>
    @endif
</div>

<!-- Remember Me -->
<div class="flex items-center gap-2">
    <flux:checkbox 
        name="remember"
        :checked="old('remember')" 
        class="!border-2 !border-black !bg-white !opacity-100 accent-[#B25C18]"
    />

    <span class="text-black font-medium opacity-100">
        Remember me
    </span>
</div>
            <div class="flex items-center justify-end">
                <flux:button 
                    type="submit"
                    class="w-full bg-[#B25C18] hover:bg-[#8F4C11] border-none py-6 text-white font-bold"
                >
                    {{ __('Masuk Sekarang') }}
                </flux:button>
            </div>
        </form>

        @if (Route::has('register'))
            <div class="space-x-1 text-sm text-center rtl:space-x-reverse text-black dark:text-black">
                <span>{{ __('Don\'t have an account?') }}</span>

                <flux:link 
                    :href="route('register')" 
                    wire:navigate 
                    :accent="false"
                    class="!text-[#B25C18] hover:!text-[#B25C18] font-bold"
                >
                    {{ __('Sign up') }}
                </flux:link>
            </div>
        @endif

    </div>
</x-layouts::auth>