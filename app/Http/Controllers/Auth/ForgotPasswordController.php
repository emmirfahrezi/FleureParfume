<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    // 1. Tampilkan form minta link reset
    public function showLinkRequestForm() {
        return view('forgot-password');
    }

    // 2. Kirim link ke email (Laravel built-in functionality)
    public function sendResetLinkEmail(Request $request) {
        $request->validate(['email' => 'required|email|exists:users,email']);

        // Laravel Password Broker akan menangani pembuatan token & pengiriman email
        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', 'Kami telah mengirimkan link reset ke email Anda!')
            : back()->withErrors(['email' => __($status)]);
    }

    // 3. Tampilkan form buat password baru
    public function showResetForm($token) {
        return view('reset-password', ['token' => $token]);
    }

    // 4. Proses update password baru
    public function reset(Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill(['password' => Hash::make($password)])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect('/login')->with('success', 'Password berhasil diubah!')
            : back()->withErrors(['email' => __($status)]);
    }
}