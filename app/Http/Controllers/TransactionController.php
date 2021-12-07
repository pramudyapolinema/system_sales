<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\ProductTransaction;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('prosesTransaksi');
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
        $transaksi = Transaction::all()->count();
        $notrans = "T" . sprintf("%06d", $transaksi+1);
        $total = 0;
        $berat = 0;
        foreach($keranjang as $k){
            $total = $total + $k->produk->harga * $k->jumlah;
            $berat = $berat + $k->produk->berat * $k->jumlah;
        }
        $ongkir = $this->check_ongkir(auth()->user()->kota, $berat);
        $trans = new Transaction;
        $trans->id_transaksi = $notrans;
        $trans->id_customer = auth()->user()->id;
        $trans->berat = $berat;
        $trans->ongkir = $ongkir;
        $trans->total_bayar = $total + $ongkir;
        $trans->status = 'Menunggu';
        $trans->save();
        foreach($keranjang as $k){
            $prodtrans = new ProductTransaction;
            $prodtrans->id_transaksi = $notrans;
            $prodtrans->id_product = $k->produk->id;
            $prodtrans->jumlah = $k->jumlah;
            $prodtrans->catatan = $k->catatan;
            $prodtrans->total = $k->produk->harga * $k->jumlah;
            $prodtrans->total_berat = $k->produk->berat * $k->jumlah;
            $prodtrans->save();
            Cart::find($k->id)->delete();
        }
        return redirect()->route('transaksi.index')
            ->with('success', 'Checkout anda berhasil!');
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

    public function konfirmasipembayaran($id){
        $transaction = Transaction::find($id);
        $transaction->status = 'Dibayar';
        $transaction->save();
        return redirect()->route('transaksi.index')
            ->with('success', "Transaksi telah dibayar!");
    }

    public function updateResi(Request $request, $id){
        $transaction = Transaction::find($id);
        $transaction->resi = $request->get('resi');
        $transaction->status = 'Dikirim';
        $transaction->save();
        return redirect()->route('transaksi.index')
            ->with('success', "Resi berhasil diupdate!");
    }

    public function prosesTransaksi(){
        switch(auth()->user()->level) {
            case 'admin':
                $transaksi = Transaction::where('status', 'Menunggu')
                    ->orWhere('status', 'Dibayar')->orderBy('created_at', 'DESC')->get();
                $produktransaksi = ProductTransaction::all();
                break;
            case 'pelanggan':
                $transaksi = Transaction::where('id_customer', auth()->user()->id)
                    ->where('status', 'Menunggu')->orWhere('status', 'Dibayar')->orderBy('created_at', 'DESC')->get();
                $produktransaksi = ProductTransaction::all();
                break;
        }
        return view('Transaction.index', compact('transaksi', 'produktransaksi'));
    }

    public function kirimTransaksi(){
        switch(auth()->user()->level) {
            case 'admin':
                $transaksi = Transaction::where('status', 'Dikirim')->orderBy('created_at', 'DESC')->get();
                $produktransaksi = ProductTransaction::all();
                break;
            case 'pelanggan':
                $transaksi = Transaction::where('id_customer', auth()->user()->id)->where('status', 'Dikirim')
                    ->orderBy('created_at', 'DESC')->get();
                $produktransaksi = ProductTransaction::all();
                break;
        }
        return view('Transaction.index', compact('transaksi', 'produktransaksi'));
    }

    public function selesaiTransaksi(){
        switch(auth()->user()->level) {
            case 'admin':
                $transaksi = Transaction::where('status', 'Selesai')->orderBy('created_at', 'DESC')->get();
                $produktransaksi = ProductTransaction::all();
                break;
            case 'pelanggan':
                $transaksi = Transaction::where('id_customer', auth()->user()->id)->where('status', 'Selesai')
                    ->orderBy('created_at', 'DESC')->get();
                $produktransaksi = ProductTransaction::all();
                break;
        }
        return view('Transaction.index', compact('transaksi', 'produktransaksi'));
    }

    public function cancelTransaksi($id){
        $transaction = Transaction::find($id);
        $transaction->status = 'Dibatalkan';
        $transaction->save();
        return redirect()->route('prosesTransaksi')->with('sucess', 'Transaksi Dibatalkan');
    }
}
