<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function index()
    {
        $dbRevenue = OrderDetail::sum('subtotal');
        $totalRevenue = $dbRevenue > 0 ? (float) $dbRevenue : 4850000;

        return view('admin.laporan', compact('totalRevenue'));
    }
}
