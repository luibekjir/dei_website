<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Rename existing 'menus' table to 'menu_items'
        // This table currently contains the dishes (items)
        Schema::rename('menus', 'menu_items');

        // 2. Create new 'menus' table for categories/sections
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurant_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->timestamps();
        });

        // 3. Add 'menu_id' to 'menu_items' to link them to the new categories
        Schema::table('menu_items', function (Blueprint $table) {
            $table->foreignId('menu_id')->nullable()->constrained('menus')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('menu_items', function (Blueprint $table) {
            $table->dropForeign(['menu_id']);
            $table->dropColumn('menu_id');
        });
        Schema::dropIfExists('menus');
        Schema::rename('menu_items', 'menus');
    }
};
