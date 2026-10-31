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
    $akun = [
        ['Admin Laundry', 'admin@laundry.test', 'admin'],
        ['Pelanggan Setia', 'pelanggan@laundry.test', 'pelanggan']
    ];

    foreach ($akun as [$nama, $email, $role]) {
        User::updateOrCreate(['email' => $email], [
            'name' => $nama,
            'password' => Hash::make('Laundry#2026'),
            'role' => $role,
        ]);
    }
}

}
