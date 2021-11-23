<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksi = Transaction::where('id_customer', auth()->user()->id)->get();
        return view('Transaction.index', compact('transaksi'));
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
        $keranjang = Cart::where('id_customer', auth()->user()->id)->get();
        $transaksi = Transaction::where('id_customer', auth()->user()->id)->get()->count();
        $notrans = "T" . sprintf("%06d", $transaksi+1);
        $total = 0;
        foreach($keranjang as $k){
            $total = $total + $k->total;
        }
        foreach ($keranjang as $k) {
            $trans = new Transaction;
            $trans->id_transaksi = $notrans;
            $trans->id_customer = $k->id_customer;
            $trans->id_product = $k->id_product;
            $trans->jumlah = $k->jumlah;
            $trans->catatan = $k->catatan;
            $trans->total = $k->total;
            $trans->total_bayar = $total + 8000;
            $trans->save();
            Cart::find($k->id)->delete();
        }
        return redirect()->route('keranjang.index')
            ->with('success', 'Checkout anda berhasil!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
