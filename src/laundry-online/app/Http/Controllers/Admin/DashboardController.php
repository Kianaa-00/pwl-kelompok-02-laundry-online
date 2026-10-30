<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Dummy data statistik untuk dashboard admin
        $stats = [
            'total_pesanan' => 128,
            'pendapatan_hari_ini' => 485000,
            'cucian_diproses' => 14,
            'pelanggan_aktif' => 95,
        ];

        // Dummy data tabel pesanan terbaru
        $recentOrders = [
            [
                'resi' => 'AMAR-8832',
                'nama' => 'Budi Santoso',
                'layanan' => 'Express (3 Jam)',
                'berat' => '3.5 Kg',
                'status' => 'Sedang Dicuci',
            ],
            [
                'resi' => 'AMAR-8833',
                'nama' => 'Siti Aminah',
                'layanan' => 'Reguler (1 Hari)',
                'berat' => '5.0 Kg',
                'status' => 'Menunggu Antar',
            ],
            [
                'resi' => 'AMAR-8834',
                'nama' => 'Ahmad Fauzi',
                'layanan' => 'Express (3 Jam)',
                'berat' => '2.0 Kg',
                'status' => 'Selesai',
            ],
        ];

        return view('admin.dashboardadmn', compact('stats', 'recentOrders'));
    }
}