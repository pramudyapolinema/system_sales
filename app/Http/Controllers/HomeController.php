<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Transaction;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        if (auth()->user()->level == 'pelanggan') {
            $keranjang = Cart::where('id_customer', auth()->user()->id)->count();
            $transaksi = Transaction::where('id_customer', auth()->user()->id)
                ->where('status', 'Menunggu')->count();
            $dibayar = Transaction::where('id_customer', auth()->user()->id)
                ->where('status', 'Dibayar')->count();
            $dikirim = Transaction::where('id_customer', auth()->user()->id)
            ->where('status', 'Dikirim')->count();
            return view('index', compact('keranjang', 'transaksi', 'dibayar', 'dikirim'));
        } else {
            return view('index');
        }
    }
}
