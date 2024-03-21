<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\User;

class authController extends Controller
{
    public function index(){
        return  view('auth.v_login');
    }

    public function store_login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // Jika autentikasi berhasil
            return redirect()->intended('/dashboard');
        } else {
            // Jika autentikasi gagal
            return redirect()->back()->withInput()->with('failed', 'Username atau Password Salah');
        }

        // dd($request->all());
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Kamu Berhasil Logout');
    }
}
