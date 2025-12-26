@extends('layouts.dashboard')

@section('content')
<h1 class="text-2xl font-bold mb-6">Pengaturan</h1>

<div class="bg-white rounded-xl shadow p-6 space-y-6">

    <div class="flex gap-4 border-b pb-3">
        <a href="#pengguna" class="text-indigo-600 font-semibold border-b-2 border-indigo-600 pb-1">Pengguna</a>

    </div>

    @if(session('success'))
    <div class="bg-green-100 text-green-700 p-4 rounded mb-4 text-sm font-medium">{{ session('success') }}</div>
    @endif
    @if(session('error'))
    <div class="bg-red-100 text-red-700 p-4 rounded mb-4 text-sm font-medium">{{ session('error') }}</div>
    @endif

    <section id="pengguna" class="space-y-6">
        <h2 class="text-lg font-semibold text-gray-700">Kelola Pengguna</h2>
        <p class="text-sm text-gray-500 mb-4">Atur role dan hak akses pengguna sistem.</p>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-600">
                <thead class="text-xs uppercase bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-6 py-3">Nama</th>
                        <th class="px-6 py-3">Email</th>
                        <th class="px-6 py-3">Role</th>
                        <th class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- LOOPING DATA ASLI DARI DATABASE  --}}
                    @foreach ($users as $user)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-3 font-medium text-gray-800">{{ $user->name }}</td>
                        <td class="px-6 py-3">{{ $user->email }}</td>
                        <td class="px-6 py-3">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold
                                {{ $user->role == 'admin' ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td class="px-6 py-3 text-center">
                            @if($user->id != auth()->id())
                            {{-- Tombol Buka Modal --}}
                            <button
                                onclick="openRoleModal({{ $user->id }}, '{{ $user->name }}', '{{ $user->role }}')"
                                class="bg-yellow-400 hover:bg-yellow-500 text-white text-xs px-3 py-1 rounded transition">
                                Ubah Role
                            </button>

                            {{-- Form Hapus User --}}
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline-block ml-1" onsubmit="return confirm('Yakin hapus user ini?');">
                                @csrf @method('DELETE')
                                <button class="bg-red-500 hover:bg-red-600 text-white text-xs px-3 py-1 rounded transition">Hapus</button>
                            </form>
                            @else
                            <span class="text-xs text-gray-400 italic">Akun Anda</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</div>

<div id="roleModal" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden transition-opacity">
    <div class="bg-white rounded-xl shadow-xl p-6 w-full max-w-sm text-center transform scale-95 transition-transform" id="modalContent">

        <h2 class="text-lg font-bold text-gray-800 mb-2">Ubah Role Pengguna</h2>
        <p id="modalUserText" class="text-gray-600 mb-4 text-sm"></p>

        {{-- FORM INI ACTION-NYA BAKAL DI-UPDATE OTOMATIS SAMA JS  --}}
        <form id="roleForm" method="POST">
            @csrf
            @method('PATCH')

            <select name="role" id="roleSelect"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 mb-6">
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>

            <div class="flex gap-2">
                <button type="button" onclick="closeRoleModal()"
                    class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 rounded-lg">Batal</button>
                <button type="submit"
                    class="flex-1 bg-green-600 hover:bg-green-700 text-white py-2 rounded-lg">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Fungsi Buka Modal & Setup Form
    function openRoleModal(userId, userName, currentRole) {
        // 1. Tampilkan Modal
        const modal = document.getElementById('roleModal');
        const content = document.getElementById('modalContent');
        modal.classList.remove('hidden');
        setTimeout(() => { // Animasi
            content.classList.remove('scale-95');
            content.classList.add('scale-100');
        }, 10);

        // 2. Isi Text Nama di Modal
        document.getElementById('modalUserText').textContent = `Ubah role untuk user: ${userName}`;

        // 3. Set Dropdown sesuai role user sekarang
        document.getElementById('roleSelect').value = currentRole;

        // 4.  UPDATE URL ACTION FORM 
        // Hasilnya nanti jadi: /admin/users/5/role
        const form = document.getElementById('roleForm');
        form.action = `/admin/users/${userId}/role`;
    }

    // Fungsi Tutup Modal
    function closeRoleModal() {
        const modal = document.getElementById('roleModal');
        const content = document.getElementById('modalContent');

        content.classList.remove('scale-100');
        content.classList.add('scale-95');

        setTimeout(() => {
            modal.classList.add('hidden');
        }, 150);
    }
</script>
@endsection