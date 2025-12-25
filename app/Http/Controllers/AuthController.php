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

    // LOGIN (Logic: Kirim sinyal 'login_success')
    public function login(Request $request) {
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
    public function register(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        // 1. Buat User Baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user' // Default role user biar aman
        ]);

        // 2. AUTO LOGIN (Ini kuncinya bang!)
        // Jadi habis daftar, gak perlu input password lagi, langsung masuk.
        Auth::login($user);

        // 3. Redirect ke Dashboard dengan sinyal 'register_success'
        return redirect('/user')->with('register_success', true);
    }

    public function logout() {
        Auth::logout();
        return redirect('/login')->with('success', 'Kamu sudah logout.');
    }
}