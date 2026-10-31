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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();

            // Relasi ke pesanan
            $table->foreignId('order_id')
                ->unique()
                ->constrained('orders')
                ->cascadeOnDelete();

            // Relasi ke jenis layanan
            $table->foreignId('service_id')
                ->constrained('services')
                ->restrictOnDelete();

            // Berat aktual, diisi setelah admin menimbang
            $table->decimal('weight', 8, 2)->nullable();

            // Harga per kilogram saat pesanan dibuat
            $table->decimal('unit_price', 12, 2);

            // Total biaya setelah berat diketahui
            $table->decimal('subtotal', 12, 2)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};