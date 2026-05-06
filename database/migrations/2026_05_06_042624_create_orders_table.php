<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->json('items'); // menyimpan array items dengan quantity dan harga
            $table->decimal('subtotal', 10, 2);
            $table->decimal('taxes', 10, 2);
            $table->decimal('delivery_fee', 10, 2)->default(19000);
            $table->decimal('negotiated_delivery_fee', 10, 2)->nullable(); // harga ongkir yang dinegosiasikan
            $table->enum('negotiation_status', ['none', 'pending', 'accepted', 'rejected'])->default('none');
            $table->text('negotiation_message')->nullable(); // pesan negosiasi
            $table->decimal('total', 10, 2);
            $table->enum('status', ['pending', 'confirmed', 'preparing', 'delivering', 'delivered', 'cancelled'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
