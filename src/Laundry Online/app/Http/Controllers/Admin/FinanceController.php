<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function index()
    {
        // Dummy data laporan keuangan bulanan/mingguan
        $totalRevenue = 4850000;
        
        return view('admin.laporan', compact('totalRevenue'));
    }
}