<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\TrackingLog;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    // Menampilkan daftar seluruh pesanan untuk dikelola admin (dari Database)
    public function index()
    {
        $dbOrders = Order::with('orderDetail.service')->latest()->get();

        if ($dbOrders->isNotEmpty()) {
            $orders = $dbOrders->map(function ($order) {
                return [
                    'id'      => $order->id,
                    'resi'    => $order->resi,
                    'nama'    => $order->customer_name,
                    'no_hp'   => $order->whatsapp,
                    'layanan' => $order->orderDetail?->service?->name ?? 'Express (3 Jam)',
                    'status'  => $order->status,
                ];
            })->toArray();
        } else {
            // Fallback ke data session / default jika database belum terisi
            $orders = session()->get('admin_orders', [
                [
                    'id'      => 1,
                    'resi'    => 'AMAR-8832',
                    'nama'    => 'Budi Santoso',
                    'no_hp'   => '081234567890',
                    'layanan' => 'Express (3 Jam)',
                    'status'  => 'Sedang Dicuci',
                ],
                [
                    'id'      => 2,
                    'resi'    => 'AMAR-8833',
                    'nama'    => 'Siti Aminah',
                    'no_hp'   => '089876543210',
                    'layanan' => 'Reguler (1 Hari)',
                    'status'  => 'Menunggu Antar',
                ],
            ]);
        }

        return view('admin.datapesan', compact('orders'));
    }

    // Memperbarui status cucian dan mencatat riwayat pelacakan
    public function updateStatus(Request $request, $id)
    {
        $newStatus = $request->input('status', 'Sedang Dicuci');

        // Coba cari dan perbarui di database
        $order = Order::find($id);

        if ($order) {
            $order->update(['status' => $newStatus]);

            // Catat log pelacakan untuk customer
            TrackingLog::create([
                'order_id'    => $order->id,
                'updated_by'  => auth()->id(),
                'status'      => $newStatus,
                'description' => "Status pesanan diperbarui oleh Admin menjadi: {$newStatus}.",
            ]);

            // Sinkronkan ke session jika ada
            $resi = $order->resi;
            if (session()->has("order_{$resi}")) {
                $custOrder = session()->get("order_{$resi}");
                $custOrder['status'] = $newStatus;
                session()->put("order_{$resi}", $custOrder);
            }

            return back()->with('success', "Status pesanan {$order->resi} berhasil diperbarui menjadi '{$newStatus}'!");
        }

        // Jika data berada di session
        $orders = session()->get('admin_orders', []);
        foreach ($orders as &$ord) {
            if ($ord['id'] == $id) {
                $ord['status'] = $newStatus;
                $resi = $ord['resi'];
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
