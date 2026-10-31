<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\TrackingLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminOrderController extends Controller
{
    // Menampilkan seluruh pesanan dari database
    public function index()
    {
        $orders = Order::with('orderDetail.service')
            ->latest()
            ->get()
            ->map(function ($order) {
                $service = $order->orderDetail?->service;

                return [
                    'id'      => $order->id,
                    'resi'    => $order->resi,
                    'nama'    => $order->customer_name,
                    'no_hp'   => $order->whatsapp,
                    'layanan' => $service
                        ? $service->name . ' (' . $service->duration . ')'
                        : 'Layanan tidak tersedia',
                    'status'  => $order->status,
                ];
            })
            ->all();

        return view('admin.datapesan', compact('orders'));
    }

    // Memperbarui status pesanan dari admin
    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:Menunggu Penjemputan Kurir,Menunggu Cuci,Sedang Dicuci,Menunggu Antar,Selesai',
        ]);

        DB::transaction(function () use ($id, $validated) {
            $order = Order::findOrFail($id);

            // Tidak membuat riwayat baru jika status tidak berubah
            if ($order->status === $validated['status']) {
                return;
            }

            // Memperbarui status pada tabel orders
            $order->update([
                'status' => $validated['status'],
            ]);

            // Menambahkan catatan perubahan pada tracking_logs
            $order->trackingLogs()->create([
                'updated_by'  => Auth::id(),
                'status'      => $validated['status'],
                'description' => 'Status pesanan diperbarui oleh admin menjadi: ' . $validated['status'],
            ]);
        });

        return back()->with(
            'success',
            "Status pesanan berhasil diperbarui menjadi '{$validated['status']}'!"
        );
    }
}
