<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // Kirim email ke admin
        Mail::raw(
            "Pesan dari: {$validated['name']} <{$validated['email']}>
\n\n{$validated['message']}",
            function ($message) use ($validated) {
                $message->to('perfumesfleure@gmail.com')
                        ->subject('Contact Form - Fleur Parfume');
            }
        );

        return back()->with('success', 'Pesan Anda berhasil dikirim!');
    }
}
