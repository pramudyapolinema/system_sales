<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produk = Product::all();
        $keranjang = Cart::where('id_customer', auth()->user()->id)->get();
        $total = 0;
        foreach($keranjang as $k){
            $total = $total + $k->total;
        }
        return view('cart.index', compact('keranjang', 'produk', 'total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_product'   => 'required',
            'jumlah'     => 'required',
        ]);
        $produk = Product::find($request->get('id_product'));
        $cart = new Cart;
        $cart->id_product = $request->get('id_product');
        $cart->id_customer = auth()->user()->id;
        $cart->jumlah = $request->get('jumlah');
        $cart->catatan = $request->get('catatan');
        $cart->total = $request->get('jumlah') * $produk->harga;
        $cart->save();

        return redirect()->route('keranjang.index')
            ->with('success', 'Keranjang berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_product'   => 'required',
            'jumlah'     => 'required',
        ]);

        $produk = Product::find($request->get('id_product'));
        $cart = Cart::find($id);
        $cart->id_product = $request->get('id_product');
        $cart->id_customer = auth()->user()->id;
        $cart->jumlah = $request->get('jumlah');
        $cart->catatan = $request->get('catatan');
        $cart->total = $request->get('jumlah') * $produk->harga;
        $cart->save();

        return redirect()->route('keranjang.index')
            ->with('success', 'Keranjang berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $keranjang = Cart::find($id);
        $keranjang->delete();
        return redirect()->route('keranjang.index')
            ->with('success', 'Keranjang berhasil dihapus');
    }
}
