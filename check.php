<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$menus = \App\Models\MenuItem::all();
$uniqueNames = [];
foreach($menus as $menu) {
    if (!isset($uniqueNames[$menu->name])) {
        $uniqueNames[$menu->name] = $menu->image;
    }
}
foreach($uniqueNames as $name => $image) {
    echo $name . " -> " . $image . "\n";
}
