<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin = User::where('level', 'admin')->get();
        $user = auth()->user()->id;
        return view('admin.index', compact('admin', 'user'));
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
        ]);

        if ($request->file('fotoprofil')) {
            $image_name = $request->file('fotoprofil')->store('images/user_profile', 'public');
        } else {
            $image_name = 'images/user_profile/user.png';
        }

        $user = new User;
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = bcrypt($request->get('password'));
        $user->fotoprofil = $image_name;
        $user->level = $request->get('level');
        $user->remember_token = Str::random(60);
        $user->save();

        return redirect()->route('admin.index')
            ->with('success', 'Admin Berhasil Ditambahkan');
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
        ]);

        $admin = User::find($id);

        if ($request->has('fotoprofil')) {
            if ($admin->fotoprofil != 'images/user_profile/user.png' && file_exists(storage_path('app/public/' . $admin->fotoprofil))) {
                Storage::delete('public/' . $admin->fotoprofil);
            }
            $image_name = $request->file('fotoprofil')->store('images/user_profile', 'public');
            $admin->fotoprofil = $image_name;
        }

        $admin->name = $request->get('name');
        $admin->email = $request->get('email');
        $admin->level = $request->get('level');
        if ($request->filled('password')) {
            $admin->password = bcrypt($request->get('password'));
        }
        $admin->save();

        return redirect()->route('admin.index')
            ->with('success', 'Data Admin berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->id != $id) {
            $user = User::find($id);
            if ($user->fotoprofil != 'images/user_profile/user.png' && file_exists(storage_path('app/public/' . $user->fotoprofil))) {
                Storage::delete('public/' . $user->fotoprofil);
            }
            $user->delete();
            return redirect()->route('admin.index')
                ->with('success', 'Admin berhasil dihapus');
        }
    }
}
