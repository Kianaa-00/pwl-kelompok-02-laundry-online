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

            // Relasi ke pengguna, boleh kosong untuk pesanan tamu
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Nomor resi unik setiap pesanan
            $table->string('resi')->unique();

            // Identitas pelanggan
            $table->string('customer_name');
            $table->string('whatsapp', 20);

            // Alamat penjemputan dan catatan
            $table->text('address');
            $table->text('notes')->nullable();

            // Status terkini pesanan
            $table->string('status', 30)
                ->default('pending')
                ->index();

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