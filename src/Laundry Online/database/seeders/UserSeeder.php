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
        User::create([
            'name' => 'Admin Pengelola Amar',
            'email' => 'admin@laundry.com',
            'password' => Hash::make('Laundry#2026'), // Sandi untuk login admin
            'role' => 'admin',
        ]);

        // 2. Akun Contoh Customer
        User::create([
            'name' => 'Budi Santoso',
            'email_or_whatsapp' => '081234567890', // Bisa login pakai nomor WA
            'password' => Hash::make('Laundry#2026'), // Sandi untuk login customer
            'role' => 'customer',
        ]);
    }
}