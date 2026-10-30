<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    // Menampilkan halaman kasir (POS)
    public function index()
    {
        return view('admin.kasir');
    }

    // Memproses input transaksi baru dari kasir fisik (Walk-in)
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'whatsapp' => 'required|string|max:15',
            'service_type' => 'required|string',
            'weight' => 'required|numeric',
        ]);

        // Simulasi penyimpanan data array / redirect sukses
        return redirect()->route('admin.kasir')->with('success', 'Transaksi kasir berhasil dicatat dan nota dicetak!');
    }
}