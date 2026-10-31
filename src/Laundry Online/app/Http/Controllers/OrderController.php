<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    // Menampilkan formulir pemesanan
    public function create()
    {
        return view('pesan');
    }

    // Menyimpan pesanan pelanggan ke database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'whatsapp' => 'required|string|max:20',
            'layanan' => 'required|string',
            'alamat' => 'required|string',
            'catatan' => 'nullable|string|max:500',
        ]);

        // Mengenali layanan yang dipilih pelanggan
        $pilihanLayanan = mb_strtolower($validated['layanan']);

        if (str_contains($pilihanLayanan, 'express')) {
            $namaLayanan = 'Express';
        } elseif (str_contains($pilihanLayanan, 'reguler')) {
            $namaLayanan = 'Reguler';
        } else {
            throw ValidationException::withMessages([
                'layanan' => 'Pilihan layanan tidak valid.',
            ]);
        }

        // Mengambil tarif layanan dari tabel services
        $service = Service::where('name', $namaLayanan)
            ->where('is_active', true)
            ->first();

        if (!$service) {
            throw ValidationException::withMessages([
                'layanan' => 'Layanan yang dipilih sedang tidak tersedia.',
            ]);
        }

        // Membuat nomor resi yang belum digunakan
        do {
            $resi = 'AMAR-' . random_int(1000, 9999);
        } while (Order::where('resi', $resi)->exists());

        // Menyimpan pesanan dan detailnya dalam satu transaksi
        $order = DB::transaction(function () use ($validated, $service, $resi) {
            $statusAwal = 'Menunggu Cuci';

            $order = Order::create([
                'user_id' => auth()->id(),
                'resi' => $resi,
                'customer_name' => $validated['nama'],
                'whatsapp' => $validated['whatsapp'],
                'address' => $validated['alamat'],
                'notes' => $validated['catatan'] ?? null,
                'status' => $statusAwal,
            ]);

            // Satu pesanan memiliki tepat satu detail layanan
            $order->orderDetail()->create([
                'service_id' => $service->id,
                'weight' => null,
                'unit_price' => $service->price_per_kg,
                'subtotal' => null,
            ]);

            // Mencatat status awal pesanan
            $order->trackingLogs()->create([
                'updated_by' => auth()->id(),
                'status' => $statusAwal,
                'description' => 'Pesanan berhasil dibuat dan menunggu proses pencucian.',
            ]);

            return $order;
        });

        // Menyimpan resi terakhir agar mudah ditemukan di halaman lacak
        session()->put('latest_order_resi', $order->resi);

        return redirect()->route('lacak.detail', [
            'resi' => $order->resi,
        ])->with(
            'success',
            "Pesanan berhasil dibuat! Kode Resi: {$order->resi}."
        );
    }

    // Menampilkan halaman pencarian resi
    public function lacakIndex(Request $request)
    {
        $resi = trim((string) $request->input('resi', ''));

        // Jika belum mencari resi, tampilkan halaman pencarian saja
        if ($resi === '') {
            return view('lacak');
        }

        return $this->renderLacakView($resi);
    }

    // Menampilkan detail pesanan berdasarkan nomor resi
    public function lacakDetail($resi)
    {
        return $this->renderLacakView($resi);
    }

    // Mengambil data pesanan dari database untuk halaman lacak
    private function renderLacakView($resi)
    {
        $order = Order::with([
            'orderDetail.service',
            'trackingLogs',
        ])->where('resi', $resi)->first();

        if (!$order) {
            return redirect()->route('lacak')
                ->withErrors([
                    'resi' => 'Nomor resi tidak ditemukan. Periksa kembali nomor resi Anda.',
                ]);
        }

        $detail = $order->orderDetail;
        $service = $detail?->service;

        $harga = $detail?->unit_price ?? $service?->price_per_kg ?? 0;

        // Menyesuaikan nama data dengan yang digunakan lacak.blade.php
        $dummyOrder = [
            'order_code' => $order->resi,
            'customer_name' => $order->customer_name,
            'whatsapp' => $order->whatsapp,
            'status' => $order->status,
            'payment_method' => 'Tunai di Tempat (Cash on Delivery)',
            'service' => $service
                ? $service->name . ' (Selesai ' . $service->duration . ')'
                : 'Layanan tidak tersedia',
            'price_rate' => 'Rp ' . number_format((float) $harga, 0, ',', '.') . ' / kg',
            'address' => $order->address,
            'catatan' => $order->notes ?: 'Tidak ada catatan',
            'created_at' => $order->created_at
                ? $order->created_at->format('Y-m-d H:i')
                : '-',
        ];

        return view('lacak', compact('dummyOrder'));
    }
}
