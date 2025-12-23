@extends('layouts.dashboard')

@section('content')
<h1 class="text-2xl font-bold mb-6">Manajemen Pengguna</h1>

<div class="bg-white rounded-xl shadow p-6">

    <!-- HEADER -->
    <div class="flex flex-col md:flex-row items-center justify-between mb-6 gap-3">
        <h2 class="text-lg font-semibold text-gray-700">Daftar Pengguna</h2>

        <!-- Tombol tambah -->
        <a href="#"
            class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm px-4 py-2 rounded-lg transition">
            + Tambah Pengguna
        </a>
    </div>

    <!-- FILTER -->
    <form action="" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-3 mb-4">
        <div class="col-span-2">
            <label class="block text-xs text-gray-500 mb-1">Cari Pengguna</label>
            <input type="text" name="q" placeholder="Cari nama atau email..."
                class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none">
        </div>
        <div>
            <label class="block text-xs text-gray-500 mb-1">Filter Role</label>
            <select name="role"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                <option value="">Semua</option>
                <option value="admin">Admin</option>
                <option value="staff">Staff</option>
                <option value="user">User</option>
            </select>
        </div>
        <div class="flex items-end">
            <button type="submit"
                class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm px-4 py-2 rounded-lg transition w-full">
                Terapkan
            </button>
        </div>
    </form>

    <!-- TABEL -->
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
                <!-- Dummy Data -->
                @foreach ([
                    ['name' => 'Najran Al-Faresy', 'email' => 'najran@example.com', 'role' => 'admin'],
                    ['name' => 'Rizky Fahri', 'email' => 'rizky@example.com', 'role' => 'staff'],
                    ['name' => 'Aulia Rahman', 'email' => 'aulia@example.com', 'role' => 'user'],
                ] as $user)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-6 py-3 font-medium text-gray-800">{{ $user['name'] }}</td>
                    <td class="px-6 py-3">{{ $user['email'] }}</td>
                    <td class="px-6 py-3">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                            {{ $user['role'] == 'admin' ? 'bg-red-100 text-red-700' : '' }}
                            {{ $user['role'] == 'staff' ? 'bg-blue-100 text-blue-700' : '' }}
                            {{ $user['role'] == 'user' ? 'bg-green-100 text-green-700' : '' }}">
                            {{ ucfirst($user['role']) }}
                        </span>
                    </td>
                    <td class="px-6 py-3 text-center">
                        <button
                            onclick="openRoleModal('{{ $user['name'] }}', '{{ $user['role'] }}')"
                            class="bg-yellow-400 hover:bg-yellow-500 text-white text-xs px-3 py-1 rounded">
                            Ubah Role
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- MODAL UBAH ROLE -->
<div id="roleModal"
    class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-xl shadow-xl p-6 w-full max-w-sm text-center transform scale-95 transition">
        <h2 class="text-lg font-bold text-gray-800 mb-2">Ubah Role Pengguna</h2>
        <p id="modalUser" class="text-gray-600 mb-4"></p>

        <select id="roleSelect"
            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 mb-4">
            <option value="admin">Admin</option>
            <option value="staff">Staff</option>
            <option value="user">User</option>
        </select>

        <div class="flex gap-2">
            <button onclick="closeRoleModal()"
                class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 rounded-lg">Batal</button>
            <button onclick="saveRole()"
                class="flex-1 bg-green-600 hover:bg-green-700 text-white py-2 rounded-lg">Simpan</button>
        </div>
    </div>
</div>

<script>
function openRoleModal(name, role) {
    document.getElementById('roleModal').classList.remove('hidden');
    document.getElementById('modalUser').textContent = `Ubah role untuk ${name}`;
    document.getElementById('roleSelect').value = role;
}

function closeRoleModal() {
    document.getElementById('roleModal').classList.add('hidden');
}

function saveRole() {
    const newRole = document.getElementById('roleSelect').value;
    alert('Role disimpan sebagai: ' + newRole + ' (FE-only, belum ke backend)');
    closeRoleModal();
}
</script>
@endsection
