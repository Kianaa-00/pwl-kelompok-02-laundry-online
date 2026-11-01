<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function index()
    {
        // 1. Total keseluruhan pendapatan
        $dbRevenue = OrderDetail::sum('subtotal');
        $totalRevenue = $dbRevenue > 0 ? (float) $dbRevenue : 4850000;

        // 2. Menghitung jumlah pesanan Reguler dan Express berdasarkan relasi service
        $regulerCount = OrderDetail::whereHas('service', function ($query) {
            $query->where('name', 'Reguler');
        })->count();

        $expressCount = OrderDetail::whereHas('service', function ($query) {
            $query->where('name', 'Express');
        })->count();

        // 3. Menghitung total pendapatan masing-masing layanan
        $regulerRevenue = OrderDetail::whereHas('service', function ($query) {
            $query->where('name', 'Reguler');
        })->sum('subtotal');

        $expressRevenue = OrderDetail::whereHas('service', function ($query) {
            $query->where('name', 'Express');
        })->sum('subtotal');

        // 4. Kirim semua data variabel ke view laporan.blade.php
        return view('admin.laporan', compact(
            'totalRevenue',
            'regulerCount',
            'expressCount',
            'regulerRevenue',
            'expressRevenue'
        ));
    }
}
