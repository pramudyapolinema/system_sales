<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        if (auth()->user()->level == 'pelanggan') {
            $keranjang = Cart::where('id_customer', auth()->user()->id)->count();
            return view('index', compact('keranjang'));
        } else {
            return view('index');
        }
    }
}
