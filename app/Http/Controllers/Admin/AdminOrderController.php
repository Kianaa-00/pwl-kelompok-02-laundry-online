<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    // Menampilkan daftar seluruh pesanan untuk dikelola admin
    public function index()
    {
        // Dummy data daftar pesanan
        $orders = [
            [
                'id' => 1,
                'resi' => 'AMAR-8832',
                'nama' => 'Budi Santoso',
                'no_hp' => '081234567890',
                'layanan' => 'Express (3 Jam)',
                'status' => 'Sedang Dicuci'
            ],
            [
                'id' => 2,
                'resi' => 'AMAR-8833',
                'nama' => 'Siti Aminah',
                'no_hp' => '089876543210',
                'layanan' => 'Reguler (1 Hari)',
                'status' => 'Menunggu Antar'
            ]
        ];

        return view('admin.datapesan', compact('orders'));
    }

    // Memperbarui status cucian
    public function updateStatus(Request $request, $id)
    {
        // Simulasi update status
        return back()->with('success', 'Status pesanan berhasil diperbarui!');
    }
}
