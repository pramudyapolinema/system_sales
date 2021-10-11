<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('Auth.login');
    }

    public function postlogin(Request $request){
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = User::where('email', $request->email)->first();
            return redirect('/')->with('success', 'Selamat Datang '. $user->name);
        } else {
            return redirect()->route('login')
                ->with('error', 'Email atau password salah!');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
