<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        Service::updateOrCreate(
            ['name' => 'Express'],
            [
                'description' => 'Layanan laundry express dengan durasi 3 jam.',
                'price_per_kg' => 15000,
                'duration' => '3 jam',
                'is_active' => true,
            ]
        );

        Service::updateOrCreate(
            ['name' => 'Reguler'],
            [
                'description' => 'Layanan laundry reguler dengan durasi 1 hari.',
                'price_per_kg' => 8000,
                'duration' => '1 hari',
                'is_active' => true,
            ]
        );
    }
}
