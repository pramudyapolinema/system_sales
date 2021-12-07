<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Kavist\RajaOngkir\Facades\RajaOngkir;

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
        $transaksi = Transaction::all()->count();
        $notrans = "T" . sprintf("%06d", $transaksi+1);
        $total = 0;
        $berat = 0;
        $ongkir = 0;
        foreach($keranjang as $k){
            $total = $total + $k->total;
            $berat = $berat + $k->produk->berat * $k->jumlah;
        }
        if(count($keranjang) > 0){
            $ongkir = $this->check_ongkir(auth()->user()->kota, $berat);
        }
        return view('cart.index', compact('keranjang', 'produk', 'total', 'notrans', 'ongkir'));
    }

    public function check_ongkir($kota, $berat)
    {
        $cost = RajaOngkir::ongkosKirim([
            'origin'        => 370, // ID kota/kabupaten asal
            'destination'   => $kota, // ID kota/kabupaten tujuan
            'weight'        => $berat, // berat barang dalam gram
            'courier'       => 'jne' // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        ])->get();

        $json = json_encode($cost);
        $data = json_decode($json, true);

        $data2 = json_encode($data[0]['costs']);
        $data3 = json_decode($data2, true);
        $data4 = $data3[0]['cost'];

        $data5 = json_encode($data4[0]['value']);
        $data6 = json_decode($data5, true);

        return $data6;
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
