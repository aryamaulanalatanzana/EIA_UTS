<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FrontendOrderController extends Controller
{
    // Menampilkan semua order
    public function index()
    {
        // Ambil data order dari microservice
        $response = Http::get('http://localhost:8003/api/orders'); // microservice order

        if ($response->successful()) {
            $orders = $response->json()['data'];
        } else {
            // Tampilkan pesan error jika gagal mendapatkan data order
            return redirect()->route('orders.index')->with('error', 'Gagal memuat data order. Silakan coba lagi.');
        }

        // Ambil data produk untuk dropdown pada form order baru
        $productsResponse = Http::get('http://localhost:8003/api/products');
        if ($productsResponse->successful()) {
            $products = $productsResponse->json()['data'];
        } else {
            // Tampilkan pesan error jika gagal mendapatkan data produk
            return redirect()->route('orders.index')->with('error', 'Gagal memuat data produk. Silakan coba lagi.');
        }

        // Tampilkan halaman dengan data yang diperoleh
        return view('orders.index', compact('orders', 'products'));
    }

    // Menyimpan order baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'items' => 'required|array|min:1',
            'items.*' => 'exists:products,id',
        ]);

        // Ambil data produk dari microservice
        $productsResponse = Http::get('http://localhost:8003/api/products');
        if ($productsResponse->successful()) {
            $products = $productsResponse->json()['data'];
        } else {
            // Tampilkan pesan error jika gagal mengambil data produk
            return redirect()->back()->with('error', 'Gagal memuat data produk.');
        }

        // Hitung total harga dan siapkan daftar items
        $totalPrice = 0;
        $items = [];

        // Loop untuk menambahkan produk dan menghitung total harga
        foreach ($request->items as $productId) {
            $product = collect($products)->firstWhere('id', $productId);
            if ($product) {
                $items[] = [
                    'product_id' => $product['id'],
                    'price' => $product['price'],
                ];
                $totalPrice += $product['price']; // Tambahkan harga produk ke total
            }
        }

        // Simpan order baru dengan total harga yang sudah dihitung
        $response = Http::post('http://localhost:8003/api/orders', [
            'user_id' => $request->user_id,
            'total_price' => $totalPrice,
            'status' => 'pending',
            'items' => $items,
        ]);

        if ($response->successful()) {
            // Jika order berhasil dibuat, tampilkan pesan sukses
            return redirect()->route('orders.index')->with('success', 'Order berhasil dibuat!');
        } else {
            // Jika gagal membuat order, tampilkan pesan error
            return redirect()->back()->with('error', 'Gagal membuat order. Silakan coba lagi.');
        }
    }
}
