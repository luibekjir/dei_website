<x-layouts::app :title="$restaurant->name">
    <livewire:restaurant-show :restaurantId="$restaurant->id" :highlightId="$highlightId" />
</x-layouts::app>
