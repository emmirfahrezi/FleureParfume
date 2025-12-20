<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin() {
        return view('auth.login');
    }

    public function showRegister() {
        return view('auth.register');
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // if (Auth::attempt($request->only('email', 'password'))) {
        //     return redirect('/')->with('success', 'Selamat datang kembali di Fleure Parfume!');
        // }

        // return back()->with('error', 'Email atau password salah.');

        if (Auth::attempt($request->only('email', 'password'))) {
        $request->session()->regenerate();
        
        // Redirect berdasarkan role
        if (Auth::user()->role == 'admin') {
            return redirect()->intended('/admin/dashboard');
        }
        return redirect()->intended('/user/dashboard');
    }

    return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect('/login')->with('success', 'Akun parfum kamu berhasil dibuat!');
    }

    public function logout() {
        Auth::logout();
        return redirect('/login')->with('success', 'Kamu sudah logout.');
    }
}
