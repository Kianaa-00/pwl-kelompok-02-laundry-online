<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    // Dummy Data untuk Halaman Layanan & Harga
    public function layanan()
    {
        $services = [
            [
                'id' => 1,
                'nama' => 'Express 3 Jam',
                'tipe' => 'express',
                'harga' => 15000,
                'estimasi' => '3 Jam Selesai',
                'deskripsi' => 'Cuci, kering, dan lipat rapi super cepat. 1 Mesin 1 Pelanggan (Higienis).'
            ],
            [
                'id' => 2,
                'nama' => 'Reguler 1 Hari',
                'tipe' => 'reguler',
                'harga' => 8000,
                'estimasi' => '24 Jam / 1 Hari',
                'deskripsi' => 'Pilihan hemat untuk kebutuhan cucian harian dengan deterjen & parfum premium.'
            ],
        ];

        return view('layanan', compact('services'));
    }
}