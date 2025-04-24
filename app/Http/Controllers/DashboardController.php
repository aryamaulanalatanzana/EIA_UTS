<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index()
    {
        $userRes = Http::get('http://localhost:8001/api/users');
        $productRes = Http::get('http://localhost:8002/api/products');
        $orderRes = Http::get('http://localhost:8003/api/orders');
        $paymentRes = Http::get('http://localhost:8004/api/payments');

        return view('dashboard', [
            'userCount' => count($userRes['data'] ?? []),
            'productCount' => count($productRes['data'] ?? []),
            'orderCount' => count($orderRes['data'] ?? []),
            'paymentCount' => count($paymentRes['data'] ?? []),
        ]);
    }
}
