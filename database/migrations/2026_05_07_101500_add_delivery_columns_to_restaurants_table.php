<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('restaurants', function (Blueprint $table) {
            $table->boolean('has_delivery')->default(false);
            $table->boolean('supports_pickup')->default(false);
            $table->enum('delivery_status', ['available', 'busy', 'offline'])->default('offline');
        });
    }

    public function down(): void
    {
        Schema::table('restaurants', function (Blueprint $table) {
            $table->dropColumn(['has_delivery', 'supports_pickup', 'delivery_status']);
        });
    }
};
