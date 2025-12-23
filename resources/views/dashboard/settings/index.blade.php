@extends('layouts.dashboard')

@section('content')
<h1 class="text-2xl font-bold mb-6">Pengaturan</h1>

<div class="bg-white rounded-xl shadow p-6 space-y-6">

    <!-- SUBMENU NAV -->
    <div class="flex gap-4 border-b pb-3">
        <a href="#pengguna" class="text-indigo-600 font-semibold border-b-2 border-indigo-600 pb-1">Pengguna</a>
        <a href="#akun" class="text-gray-500 hover:text-indigo-600">Akun Saya</a>
        <a href="#preferensi" class="text-gray-500 hover:text-indigo-600">Preferensi</a>
    </div>

    <!-- SECTION: PENGGUNA -->
    <section id="pengguna" class="space-y-6">
        <h2 class="text-lg font-semibold text-gray-700">Kelola Pengguna</h2>
        <p class="text-sm text-gray-500 mb-4">
            Atur role dan hak akses pengguna sistem.
        </p>

        <!-- TABEL USER -->
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
    </section>
</div>

<!-- MODAL -->
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
    alert('Role disimpan sebagai: ' + newRole + ' (FE-only)');
    closeRoleModal();
}
</script>
@endsection
