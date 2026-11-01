<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderApiController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => Order::with('orderDetail.service')->latest()->get()
        ]);
    }

    public function show($resi)
    {
        $order = Order::with('orderDetail.service', 'trackingLogs')->where('resi', $resi)->first();
        
        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Resi tidak ditemukan'], 404);
        }

        return response()->json(['success' => true, 'data' => $order]);
    }
}