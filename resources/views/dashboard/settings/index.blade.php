@extends('layouts.dashboard')

@section('content')
<h1 class="text-xl sm:text-2xl font-bold mb-4 sm:mb-6">Pengaturan</h1>

<div class="bg-white rounded-xl shadow p-4 sm:p-6 space-y-6">

    <!-- SUBMENU NAV -->
    <div class="flex flex-wrap gap-3 border-b pb-3 text-sm sm:text-base">
        <a href="#pengguna" class="text-indigo-600 font-semibold border-b-2 border-indigo-600 pb-1">Pengguna</a>

    </div>

    <!-- SECTION: PENGGUNA -->
    <section id="pengguna" class="space-y-4 sm:space-y-6">
        <h2 class="text-base sm:text-lg font-semibold text-gray-700">Kelola Pengguna</h2>
        <p class="text-xs sm:text-sm text-gray-500 mb-4">
            Atur role dan hak akses pengguna sistem.
        </p>

        <!-- TABEL -->
        <div class="hidden sm:block overflow-x-auto">
            <table class="w-full min-w-[500px] text-sm text-left text-gray-600">
                <thead class="text-xs uppercase bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 sm:px-6 py-3">Nama</th>
                        <th class="px-4 sm:px-6 py-3">Email</th>
                        <th class="px-4 sm:px-6 py-3">Role</th>
                        <th class="px-4 sm:px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- LOOPING DATA ASLI DARI DATABASE  --}}
                    @foreach ($users as $user)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 sm:px-6 py-3 font-medium text-gray-800">{{ $user['name'] }}</td>
                        <td class="px-4 sm:px-6 py-3 break-all">{{ $user['email'] }}</td>
                        <td class="px-4 sm:px-6 py-3">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold
                                {{ $user->role == 'admin' ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td class="px-4 sm:px-6 py-3 text-center">
                            <button
                                onclick="openRoleModal('{{ $user['name'] }}', '{{ $user['role'] }}')"
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

        <!-- MOBILE CARD VIEW -->
        <div class="sm:hidden space-y-3">
            @foreach ([
                ['name' => 'Najran Al-Faresy', 'email' => 'najran@example.com', 'role' => 'admin'],
                ['name' => 'Rizky Fahri', 'email' => 'rizky@example.com', 'role' => 'staff'],
                ['name' => 'Aulia Rahman', 'email' => 'aulia@example.com', 'role' => 'user'],
            ] as $user)
            <div class="border rounded-lg p-4 text-sm shadow-sm">
                <p class="font-semibold text-gray-800">{{ $user['name'] }}</p>
                <p class="text-gray-500 text-xs mb-2">{{ $user['email'] }}</p>
                <div class="flex items-center justify-between">
                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                        {{ $user['role'] == 'admin' ? 'bg-red-100 text-red-700' : '' }}
                        {{ $user['role'] == 'staff' ? 'bg-blue-100 text-blue-700' : '' }}
                        {{ $user['role'] == 'user' ? 'bg-green-100 text-green-700' : '' }}">
                        {{ ucfirst($user['role']) }}
                    </span>
                    <button
                        onclick="openRoleModal('{{ $user['name'] }}', '{{ $user['role'] }}')"
                        class="bg-yellow-400 hover:bg-yellow-500 text-white text-xs px-3 py-1 rounded transition">
                        Ubah Role
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </section>
</div>

<!-- MODAL -->
<div id="roleModal"
    class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden px-3">
    <div class="bg-white rounded-xl shadow-xl p-5 w-full max-w-sm text-center transform transition-all duration-300 scale-95">
        <h2 class="text-base sm:text-lg font-bold text-gray-800 mb-2">Ubah Role Pengguna</h2>
        <p id="modalUser" class="text-gray-600 mb-4 text-sm"></p>

        <select id="roleSelect"
            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 mb-4">
            <option value="admin">Admin</option>
            <option value="staff">Staff</option>
            <option value="user">User</option>
        </select>

        <div class="flex flex-col sm:flex-row gap-2">
            <button onclick="closeRoleModal()"
                class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 rounded-lg transition">Batal</button>
            <button onclick="saveRole()"
                class="flex-1 bg-green-600 hover:bg-green-700 text-white py-2 rounded-lg transition">Simpan</button>
        </div>
    </div>
</div>

<script>
function openRoleModal(name, role) {
    const modal = document.getElementById('roleModal');
    const box = modal.querySelector('div > div');
    document.getElementById('modalUser').textContent = `Ubah role untuk ${name}`;
    document.getElementById('roleSelect').value = role;
    modal.classList.remove('hidden');
    setTimeout(() => box.classList.remove('scale-95'), 10);
}

function closeRoleModal() {
    const modal = document.getElementById('roleModal');
    const box = modal.querySelector('div > div');
    box.classList.add('scale-95');
    setTimeout(() => modal.classList.add('hidden'), 150);
}

function saveRole() {
    const newRole = document.getElementById('roleSelect').value;
    alert('Role disimpan sebagai: ' + newRole + ' (FE-only)');
    closeRoleModal();
}
</script>
@endsection