<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    // LOGIN (Logic: Kirim sinyal 'login_success')
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            // Cek Role Admin
            if (Auth::user()->role == 'admin') {
                return redirect()->intended('/admin/dashboard')
                    ->with('login_success', true);
            }

            // User Biasa
            return redirect()->intended('/user')
                ->with('login_success', true);
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    // REGISTER (Logic Baru: Auto Login + Kirim sinyal 'register_success')
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        // 1. Buat User Baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user'
        ]);


        // Auth::login($user); 

        // Kasih pesan 'success' biar nanti muncul notif hijau di halaman login
        return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login dulu ya Bang.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Kamu sudah logout.');
    }
}
