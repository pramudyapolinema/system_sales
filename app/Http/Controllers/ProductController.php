<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        ]);

        if ($request->file('foto_produk')) {
            $image_name = $request->file('foto_produk')->store('images/produk', 'public');
        } else {
            $image_name = 'images/produk/produk.png';
        }

        $produk = new Product;
        $produk->nama_produk = $request->get('nama_produk');
        $produk->deskripsi = $request->get('deskripsi');
        $produk->foto_produk = $image_name;
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
        ]);

        $produk = Product::find($id);

        if ($request->has('foto_produk')) {
            if($produk->foto_produk != 'images/produk/produk.png' && file_exists(storage_path('app/public/'.$produk->foto_produk))) {
                Storage::delete('public/'.$produk->foto_produk);
            }
            $image_name = $request->file('foto_produk')->store('images/produk', 'public');
            $produk->foto_produk = $image_name;
        } else {
            $image_name = 'images/produk/produk.png';
        }

        $produk->nama_produk = $request->get('nama_produk');
        $produk->deskripsi = $request->get('deskripsi');
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
        Product::find($id)->delete();
        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil dihapus');
    }
}
