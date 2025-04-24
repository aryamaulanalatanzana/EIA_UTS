<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FrontendPaymentController extends Controller
{
    public function index()
    {
        $response = Http::get('http://localhost:8004/api/payments');
        $payments = $response->json();

        return view('payments.index', ['payments' => $payments['data']]);
    }

    public function store(Request $request)
    {
        $response = Http::post('http://localhost:8004/api/payments', [
            'user_id' => $request->user_id,
            'amount' => $request->amount,
            'currency' => $request->currency,
            'method' => $request->method,
            'status' => 'pending',
            'transaction_id' => $request->transaction_id,
        ]);

        return redirect()->route('payments.index');
    }
}
