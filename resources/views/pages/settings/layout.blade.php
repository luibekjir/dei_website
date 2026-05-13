<!-- resources/views/pages/settings/layout.blade.php -->
<div {{ $attributes->merge(['class' => 'p-6 bg-white rounded-lg shadow-sm']) }}>
    @if(isset($heading))
        <h2 class="text-xl font-bold text-gray-800 mb-2">{{ $heading }}</h2>
    @endif
    @if(isset($subheading))
        <p class="text-sm text-gray-600 mb-4">{{ $subheading }}</p>
    @endif
    {{ $slot }}
</div>
