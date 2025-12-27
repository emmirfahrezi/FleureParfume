<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Metadata\BackupGlobals;

class AdminUserController extends Controller
{
    public function index()
    {
        //ambil user dari database
        $users = User::latest()->get();
        return view('dashboard.settings.index', compact('users'));
    }

    //logic update role
    public function updateRole(Request $request, $id)
    {
        //cari user dari id
        $user = User::findOrFail($id);

        //validasi role
        $request->validate([
            'role' => 'required|in:admin,user',
        ]);

        //cegah admin nurunin role
        if ($user->id == Auth::id()) {
            return back()->with('error', 'Anda tidak bisa mengubah role anda sendiri!!');
        }

        //update ke database
        $user->update([
            'role' => $request->role
        ]);

        return back()->with('success', 'Role user berhasil diubah!!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        //security jangan hapus diri sendiri
        if ($user->id == Auth::id()) {
            return back()->with('error', 'Anda tidak boleh menghapus akun sendiri!!');
        }

        $user->delete();
        return back()->with('success', 'User berhasil dihapus!!');
    }
}
