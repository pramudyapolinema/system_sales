<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\OracleBucket;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produk = Product::all();
        return view('produk.index', compact('produk'));
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
            'nama_produk'   => 'required',
            'deskripsi'     => 'required',
            'harga'         => 'required',
            'berat'         => 'required',
        ]);

        if ($request->file('foto_produk')) {
            $file = $request->file('foto_produk');
            $name = rand().'.'.$file->getClientOriginalName();
            $file->move('images/products', $name);
            $cloud = new OracleBucket;
            $image_name = $cloud->upload_file_oracle('system_sales', 'images', 'images/products/'.$name);
        } else {
            $image_name = 'images/products/produk.png';
        }

        $produk = new Product;
        $produk->nama_produk = $request->get('nama_produk');
        $produk->deskripsi = $request->get('deskripsi');
        $produk->foto_produk = $image_name;
        $produk->harga = $request->get('harga');
        $produk->berat = $request->get('berat');
        $produk->save();

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_produk'   => 'required',
            'deskripsi'     => 'required',
            'harga'         => 'required',
            'berat'         => 'required',
        ]);

        $produk = Product::find($id);

        if ($request->has('foto_produk')) {
            $file = $request->file('foto_produk');
            $name = rand().'.'.$file->getClientOriginalName();
            $file->move('images/products', $name);
            $cloud = new OracleBucket;
            $image_name = $cloud->upload_file_oracle('system_sales', 'images', 'images/products/'.$name);
            $produk->foto_produk = $image_name;
        } else {
            $image_name = 'images/products/produk.png';
        }

        $produk->nama_produk = $request->get('nama_produk');
        $produk->deskripsi = $request->get('deskripsi');
        $produk->harga = $request->get('harga');
        $produk->berat = $request->get('berat');
        $produk->save();

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produk = Product::find($id);
        // if (/*-$produk->foto_produk != 'images/user_profile/user.png' && */ file_exists(storage_path('app/public/'.$produk->foto_produk))){
        //     Storage::delete('public/'.$produk->foto_produk);
        // }
        unlink('images/products/'.basename($produk->foto_produk));
        $oracle = new OracleBucket;
        $oracle->delete_file_oracle('images/images/products', basename($produk->foto_produk));
        $produk->delete();
        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil dihapus');
    }
}
