<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create()
    {
        return view('pesan');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'whatsapp' => 'required|string|max:20',
            'layanan' => 'required|string',
            'alamat' => 'required|string',
            'catatan' => 'nullable|string|max:500',
        ]);

        // Generate nomor resi unik (contoh: AMAR-7842)
        $resi = 'AMAR-' . rand(1000, 9999);

        // Tentukan tarif dan nama layanan
        $isExpress = str_contains(strtolower($validated['layanan']), 'express');
        $serviceName = $isExpress ? 'Express (Selesai 3 Jam)' : 'Reguler (Selesai 1 Hari)';
        $priceRate = $isExpress ? 'Rp 15.000 / kg' : 'Rp 8.000 / kg';

        $newOrder = [
            'id' => time(),
            'order_code' => $resi,
            'resi' => $resi,
            'customer_name' => $validated['nama'],
            'nama' => $validated['nama'],
            'whatsapp' => $validated['whatsapp'],
            'no_hp' => $validated['whatsapp'],
            'service' => $serviceName,
            'layanan' => $serviceName,
            'price_rate' => $priceRate,
            'address' => $validated['alamat'],
            'catatan' => !empty($validated['catatan']) ? $validated['catatan'] : 'Tidak ada catatan',
            'status' => 'Menunggu Penjemputan Kurir',
            'payment_method' => 'Tunai di Tempat (Cash on Delivery)',
            'created_at' => now()->format('Y-m-d H:i')
        ];

        // Simpan detail order ke session
        session()->put("order_{$resi}", $newOrder);
        session()->put("latest_order_resi", $resi);

        // Hubungkan langsung ke daftar pesanan admin
        $adminOrders = session()->get('admin_orders', [
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
        ]);

        // Sisipkan pesanan baru di posisi teratas
        array_unshift($adminOrders, [
            'id' => $newOrder['id'],
            'resi' => $newOrder['resi'],
            'nama' => $newOrder['nama'],
            'no_hp' => $newOrder['whatsapp'],
            'layanan' => $newOrder['layanan'],
            'status' => $newOrder['status']
        ]);
        session()->put('admin_orders', $adminOrders);

        return redirect()->route('lacak.detail', ['resi' => $resi])
            ->with('success', "Pesanan Anda berhasil dikonfirmasi! Kode Resi: {$resi}. Kurir kami akan segera menuju lokasi Anda.");
    }

    public function lacakIndex(Request $request)
    {
        $resi = $request->input('resi') ?: session('latest_order_resi', 'AMAR-8829');
        return $this->renderLacakView($resi);
    }

    public function lacakDetail($resi)
    {
        return $this->renderLacakView($resi);
    }

    private function renderLacakView($resi)
    {
        // Cari dari sesi customer
        $dummyOrder = session()->get("order_{$resi}");

        // Jika tidak ada di sesi customer, cari sinkronisasi dari admin_orders
        if (!$dummyOrder) {
            $adminOrders = session()->get('admin_orders', []);
            $foundInAdmin = collect($adminOrders)->firstWhere('resi', $resi);

            $dummyOrder = [
                'order_code' => $resi,
                'customer_name' => $foundInAdmin['nama'] ?? 'Budi Santoso',
                'whatsapp' => $foundInAdmin['no_hp'] ?? '081234567890',
                'service' => $foundInAdmin['layanan'] ?? 'Express (Selesai 3 Jam)',
                'status' => $foundInAdmin['status'] ?? 'Sedang Dicuci (Mesin #02)',
                'address' => 'Jl. Merpati No. 12, Kost Putri Asri, Kamar 04',
                'price_rate' => 'Rp 15.000 / kg',
                'catatan' => 'Pakaian putih dipisah',
                'payment_method' => 'Tunai di Tempat (Cash on Delivery)',
                'created_at' => now()->format('Y-m-d H:i')
            ];
        }

        return view('lacak', compact('dummyOrder'));
    }
}
