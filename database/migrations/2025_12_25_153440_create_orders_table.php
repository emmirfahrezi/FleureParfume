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
            
            // Informasi Kontak
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->text('note')->nullable();
            
            // Alamat Pengiriman
            $table->text('address');
            $table->string('city');
            $table->string('province');
            $table->string('postal_code');
            
            // Pembayaran
            $table->string('payment_method'); // bank, ewallet, cod
            $table->enum('payment_status', ['pending', 'paid', 'failed'])->default('pending');
            
            // Order Info
            $table->decimal('subtotal', 10, 2);
            $table->decimal('shipping_cost', 10, 2)->default(0);
            $table->decimal('total', 10, 2);
            $table->enum('status', ['pending', 'processing', 'shipped', 'delivered', 'cancelled'])->default('pending');
            
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
