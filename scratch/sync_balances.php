<?php

use App\Models\Restaurant;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';

$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "Starting balance synchronization...\n";

$restaurants = Restaurant::all();

foreach ($restaurants as $restaurant) {
    echo "Processing {$restaurant->name}...\n";
    
    $totalRevenue = Order::where('restaurant_id', $restaurant->id)
        ->whereIn('status', ['confirmed', 'completed', 'delivered'])
        ->sum('total');
        
    $restaurant->update(['balance' => $totalRevenue]);
    
    echo "  -> New Balance: Rp " . number_format($totalRevenue, 0, ',', '.') . "\n";
}

echo "Synchronization complete!\n";
