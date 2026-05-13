@props([
    'title',
    'description',
])

<div class="flex w-full flex-col text-center mb-8">
    <h2 class="text-2xl font-black text-[#1D1D1B] tracking-tight">{{ $title }}</h2>
    <p class="text-sm text-[#AB7B45] mt-2">{{ $description }}</p>
</div>
