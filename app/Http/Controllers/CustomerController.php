<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pelanggan = User::where('level', 'pelanggan')->get();
        return view('customer.index', compact('pelanggan'));
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
            'name'      => 'required',
            'email'     => 'required',
            'password'  => 'required',
            'level'     => 'required',
            'phone'     => 'required',
            'alamat'    => 'required',
        ]);

        if($request->file('fotoprofil')){
            $image_name = $request->file('fotoprofil')->store('images/user_profile', 'public');
        } else {
            $image_name = 'images/user_profile/user.png';
        }

        $user = new User;
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->phone = $request->get('phone');
        $user->alamat = $request->get('alamat');
        $user->password = bcrypt($request->get('password'));
        $user->fotoprofil = $image_name;
        $user->level = $request->get('level');
        $user->remember_token = Str::random(60);
        $user->save();

        return redirect()->route('pelanggan.index')
            ->with('success', 'Pelanggan Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'      => 'required',
            'email'     => 'required',
            'level'     => 'required',
            'phone'     => 'required',
            'alamat'    => 'required',
        ]);

        $user = User::find($id);

        if($request->has('fotoprofil')){
            if($user->fotoprofil != 'images/user_profile/user.png' && file_exists(storage_path('app/public/'.$user->fotoprofil))){
                Storage::delete('public/'.$user->fotoprofil);
            }
            $image_name = $request->file('fotoprofil')->store('images/user_profile', 'public');
            $user->fotoprofil = $image_name;
        }

        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->phone = $request->get('phone');
        $user->alamat = $request->get('alamat');
        $user->level = $request->get('level');
        if($request->filled('password')){
            $user->password = bcrypt($request->get('password'));
        }
        $user->save();

        return redirect()->route('pelanggan.index')
            ->with('success', 'Data Pelanggan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if($user->fotoprofil != 'images/user_profile/user.png' && file_exists(storage_path('app/public/'.$user->fotoprofil))){
            Storage::delete('public/'.$user->fotoprofil);
        }
        $user->delete();
        return redirect()->route('pelanggan.index')
            ->with('success', 'Pelanggan berhasil dihapus');
    }
}
