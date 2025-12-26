<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $googleUser = Socialite::driver('google')->user();

        //Cari user berdasarkan email
        $user = User::where('email', $googleUser->getEmail())->first();

        if (!$user) {
            //kalo belum ada buat user baru
            $user = user::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
                'password' => null,
                'role' => 'user'
            ]);
        } else {
            //kalo udah ada ke link google id
            $user->update([
                'google_id' => $googleUser->getId(),
            ]);
        }

        //login ke ke aplikasi yang sudah ada
        Auth::login($user);

        //role
        if ($user->role === 'admin') {
            return redirect('/admin/dashboard')->with('login_success', true);
        }

        return redirect('/user')->with('login_success', true);
    }
}
