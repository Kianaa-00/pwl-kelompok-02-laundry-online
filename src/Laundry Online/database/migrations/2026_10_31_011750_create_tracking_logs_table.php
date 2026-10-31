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
        Schema::create('tracking_logs', function (Blueprint $table) {
            $table->id();

            // Pesanan yang mengalami perubahan status
            $table->foreignId('order_id')
                ->constrained('orders')
                ->cascadeOnDelete();

            // Admin yang memperbarui status
            // NULL jika perubahan dilakukan otomatis oleh sistem
            $table->foreignId('updated_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Status pesanan pada saat perubahan
            $table->string('status', 30);

            // Keterangan tambahan
            $table->text('description')->nullable();

            // Waktu perubahan status
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tracking_logs');
    }
};