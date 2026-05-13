<!-- resources/views/components/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Culinary Atelier' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#FEF6ED] text-[#1A1A1A]">
    {{ $slot }}
    <!-- DEBUG: CHAT COMPONENT SHOULD BE BELOW -->
    @livewire('chat-component')

    <!-- Global Notification Toast -->
    <div x-data="{ 
            show: false, 
            message: '', 
            type: 'success',
            timeout: null 
         }"
         @notify.window="
            message = $event.detail.message;
            type = $event.detail.type || 'success';
            show = true;
            clearTimeout(timeout);
            timeout = setTimeout(() => show = false, 5000);
         "
         x-show="show"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 translate-y-4"
         class="fixed bottom-10 left-1/2 -translate-x-1/2 z-[300] px-8 py-4 rounded-2xl shadow-2xl font-bold text-sm tracking-wide border backdrop-blur-md flex items-center gap-4"
         :class="{
            'bg-white/90 border-[#F0DECB] text-[#1D1D1B]': type === 'success',
            'bg-red-500/90 border-red-600 text-white': type === 'error'
         }"
         style="display: none;">
        <span x-text="type === 'success' ? '✅' : '❌'"></span>
        <span x-text="message"></span>
    </div>
</body>
</html>
