<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    private function getDefaultOrders()
    {
        return [
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
    }

    // Menampilkan daftar seluruh pesanan untuk dikelola admin
    public function index()
    {
        $orders = session()->get('admin_orders', $this->getDefaultOrders());
        return view('admin.datapesan', compact('orders'));
    }

    // Memperbarui status cucian
    public function updateStatus(Request $request, $id)
    {
        $newStatus = $request->input('status', 'Sedang Dicuci');
        $orders = session()->get('admin_orders', $this->getDefaultOrders());

        foreach ($orders as &$order) {
            if ($order['id'] == $id) {
                $order['status'] = $newStatus;

                // Sinkronkan ke session order customer jika ada
                $resi = $order['resi'];
                if (session()->has("order_{$resi}")) {
                    $custOrder = session()->get("order_{$resi}");
                    $custOrder['status'] = $newStatus;
                    session()->put("order_{$resi}", $custOrder);
                }
                break;
            }
        }

        session()->put('admin_orders', $orders);

        return back()->with('success', "Status pesanan berhasil diperbarui menjadi '{$newStatus}'!");
    }
}
