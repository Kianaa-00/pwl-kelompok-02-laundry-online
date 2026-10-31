<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Service;
use App\Models\Order;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Pengguna Default (Admin & Pelanggan)
        $admin = User::updateOrCreate(['email' => 'admin@amarlaundry.com'], [
            'name'     => 'Admin Pengelola Amar',
            'whatsapp' => '081200000001',
            'password' => Hash::make('admin123'),
            'role'     => 'admin',
        ]);

        $pelanggan = User::updateOrCreate(['email' => 'pelanggan@amarlaundry.com'], [
            'name'     => 'Budi Santoso',
            'whatsapp' => '081234567890',
            'password' => Hash::make('budi123'),
            'role'     => 'pelanggan',
        ]);

        // 2. Data Master Layanan Laundry
        $express = Service::updateOrCreate(['name' => 'Express'], [
            'description'  => 'Cuci, kering, dan lipat rapi super cepat (3 Jam Selesai). 1 Mesin 1 Pelanggan (Higienis).',
            'price_per_kg' => 15000,
            'duration'     => '3 Jam',
            'is_active'    => true,
        ]);

        $reguler = Service::updateOrCreate(['name' => 'Reguler'], [
            'description'  => 'Pilihan hemat untuk kebutuhan cucian harian dengan deterjen & parfum premium (24 Jam Selesai).',
            'price_per_kg' => 8000,
            'duration'     => '1 Hari',
            'is_active'    => true,
        ]);

        // 3. Contoh Data Pesanan Awal untuk Pengujian
        $order1 = Order::updateOrCreate(['resi' => 'AMAR-8832'], [
            'user_id'       => $pelanggan->id,
            'customer_name' => 'Budi Santoso',
            'whatsapp'      => '081234567890',
            'address'       => 'Jl. Merpati No. 12, Kost Asri, Kamar 04',
            'notes'         => 'Pakaian putih tolong dipisah.',
            'status'        => 'Sedang Dicuci',
        ]);

        $order1->orderDetail()->updateOrCreate(['order_id' => $order1->id], [
            'service_id' => $express->id,
            'weight'     => 3.5,
            'unit_price' => $express->price_per_kg,
            'subtotal'   => 3.5 * $express->price_per_kg,
        ]);

        $order1->trackingLogs()->create([
            'updated_by'  => $admin->id,
            'status'      => 'Sedang Dicuci',
            'description' => 'Pesanan sedang dalam proses pencucian mesin #02.',
        ]);

        $order2 = Order::updateOrCreate(['resi' => 'AMAR-8833'], [
            'user_id'       => null,
            'customer_name' => 'Siti Aminah',
            'whatsapp'      => '089876543210',
            'address'       => 'Jl. Anggrek No. 5, Blok C',
            'notes'         => 'Tolong gunakan pewangi ekstra.',
            'status'        => 'Menunggu Antar',
        ]);

        $order2->orderDetail()->updateOrCreate(['order_id' => $order2->id], [
            'service_id' => $reguler->id,
            'weight'     => 5.0,
            'unit_price' => $reguler->price_per_kg,
            'subtotal'   => 5.0 * $reguler->price_per_kg,
        ]);

        $order2->trackingLogs()->create([
            'updated_by'  => $admin->id,
            'status'      => 'Menunggu Antar',
            'description' => 'Cucian telah rapi dan siap diantarkan oleh kurir.',
        ]);
    }
}
