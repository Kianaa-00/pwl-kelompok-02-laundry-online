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
        ]);

        // Generate nomor resi unik (contoh: AMAR-xxxx)
        $resi = 'AMAR-' . strtoupper(substr(uniqid(), -4));

        return redirect()->route('lacak.detail', ['resi' => $resi])
            ->with('success', 'Pesanan berhasil dibuat! Silakan lacak status cucian Anda.');
    }

    public function lacakIndex(Request $request)
    {
        $resi = $request->input('resi', 'AMAR-8829');
        return $this->renderLacakView($resi);
    }

    public function lacakDetail($resi)
    {
        return $this->renderLacakView($resi);
    }

    private function renderLacakView($resi)
    {
        $dummyOrder = [
            'order_code' => $resi,
            'customer_name' => 'Budi Santoso',
            'whatsapp' => '081234567890',
            'service' => 'Express (Selesai 3 Jam)',
            'status' => 'Sedang Dicuci (Mesin #02)',
            'total_price' => 45000,
            'created_at' => now()->format('Y-m-d H:i')
        ];

        return view('lacak', compact('dummyOrder'));
    }
}
