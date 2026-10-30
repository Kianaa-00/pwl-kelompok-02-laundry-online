<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Akun Admin
        User::firstOrCreate(
            ['email' => 'admin@amarlaundry.com'],
            [
                'name' => 'Admin Amar',
                'whatsapp' => '081234567890',
                'role' => 'admin',
                'password' => Hash::make('password'),
            ]
        );

        // Akun Pelanggan Contoh
        User::firstOrCreate(
            ['email' => 'budi@gmail.com'],
            [
                'name' => 'Budi Santoso',
                'whatsapp' => '089876543210',
                'role' => 'customer',
                'password' => Hash::make('password'),
            ]
        );
    }
}
