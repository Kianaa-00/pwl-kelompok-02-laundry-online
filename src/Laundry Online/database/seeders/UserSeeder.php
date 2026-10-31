<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Admin / Pengelola Laundry
        User::updateOrCreate(['email' => 'admin@amarlaundry.com'], [
            'name'     => 'Admin Pengelola Amar',
            'whatsapp' => '081200000001',
            'password' => Hash::make('admin123'),
            'role'     => 'admin',
        ]);

        // 2. Akun Pelanggan
        User::updateOrCreate(['email' => 'pelanggan@amarlaundry.com'], [
            'name'     => 'Budi Santoso',
            'whatsapp' => '081234567890',
            'password' => Hash::make('budi123'),
            'role'     => 'pelanggan',
        ]);
    }
}
