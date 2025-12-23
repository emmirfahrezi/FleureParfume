@extends('layouts.dashboard')

@section('content')
<h1 class="text-2xl font-bold mb-6">Data Pesanan</h1>

<div class="bg-white rounded-xl shadow p-6">

    <!-- HEADER -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <h2 class="text-lg font-semibold text-gray-700">
            Daftar Pesanan
        </h2>

        <div class="flex gap-2">
            <!-- FILTER TANGGAL -->
            <input
                type="date"
                id="dateFilter"
                class="border border-gray-300 rounded-lg px-3 py-2 text-sm
                       focus:outline-none focus:ring-2 focus:ring-indigo-500"
            />

            <!-- SEARCH -->
            <input
                type="text"
                id="searchInput"
                placeholder="Cari ID / Nama Customer..."
                class="border border-gray-300 rounded-lg px-4 py-2 text-sm
                       focus:outline-none focus:ring-2 focus:ring-indigo-500"
            >

            <!-- FILTER -->
            <select
                class="border border-gray-300 rounded-lg px-3 py-2 text-sm 
                       focus:outline-none focus:ring-2 focus:ring-indigo-500" id="statusFilter">
                <option value="">Semua Status</option>
                <option value="notyetpaid">Belum Dibayar</option>
                <option value="delivery">Dikirim</option>
                <option value="process">Diproses</option>
                <option value="done">Selesai</option>
                <option value="cancel">Dibatalkan</option>
            </select>
        </div>
    </div>

    <!-- TABLE -->
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-600">
            <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-center">ID Pesanan</th>
                    <th class="px-6 py-3 text-center">Customer</th>
                    <th class="px-6 py-3 text-center">Tanggal</th>
                    <th class="px-6 py-3 text-center">Total</th>
                    <th class="px-6 py-3 text-center">Status</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody id="orderTable">

                <!-- ROW 1 -->
                <tr class="border-b hover:bg-gray-50" data-status="notyetpaid" data-date="2025-12-20">
                    <td class="px-6 py-4 font-medium text-center text-gray-800">
                        #ORD-001
                    </td>
                    <td class="px-6 py-4 text-center">
                        Najran Al-Faresy
                    </td>
                    <td class="px-6 py-4 text-center">
                        20 Des 2025
                    </td>
                    <td class="px-6 py-4 text-center">
                        Rp 750.000
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">
                            Belum Dibayar
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center space-x-2">
                        <a href="/show"
                           class="px-3 py-1 text-xs text-white bg-indigo-600 rounded hover:bg-indigo-700">
                            Detail
                        </a>
                    </td>
                </tr>

                <!-- ROW 2 -->
                <tr class="border-b hover:bg-gray-50" data-status="delivery" data-date="2025-12-19">
                    <td class="px-6 py-4 font-medium text-center text-gray-800">
                        #ORD-002
                    </td>
                    <td class="px-6 py-4 text-center">
                        Aulia Rahma
                    </td>
                    <td class="px-6 py-4 text-center">
                        19 Des 2025
                    </td>
                    <td class="px-6 py-4 text-center">
                        Rp 1.200.000
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-700">
                            Dikirim
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center space-x-2">
                        <a href="/show"
                           class="px-3 py-1 text-xs text-white bg-indigo-600 rounded hover:bg-indigo-700">
                            Detail
                        </a>
                    </td>
                </tr>

                <!-- ROW 3 -->
                <tr class="border-b hover:bg-gray-50" data-status="done" data-date="2025-12-18">
                    <td class="px-6 py-4 font-medium text-center text-gray-800">
                        #ORD-003
                    </td>
                    <td class="px-6 py-4 text-center">
                        Budi Santoso
                    </td>
                    <td class="px-6 py-4 text-center">
                        18 Des 2025
                    </td>
                    <td class="px-6 py-4 text-center">
                        Rp 450.000
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700">
                            Selesai
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center space-x-2">
                        <a href="/show"
                           class="px-3 py-1 text-xs text-white bg-indigo-600 rounded hover:bg-indigo-700">
                            Detail
                        </a>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</div>

<!-- SEARCH SCRIPT -->
<script>
const searchInput  = document.getElementById('searchInput');
const statusFilter = document.getElementById('statusFilter');
const dateFilter   = document.getElementById('dateFilter');
const rows = document.querySelectorAll('#orderTable tr');

function filterTable() {
    const searchText = searchInput.value.toLowerCase();
    const selectedStatus = statusFilter.value.toLowerCase();
    const selectedDate = dateFilter.value; // YYYY-MM-DD

    rows.forEach(row => {
        const rowText   = row.innerText.toLowerCase();
        const rowStatus = row.dataset.status.toLowerCase();
        const rowDate   = row.dataset.date;

        const matchSearch = rowText.includes(searchText);
        const matchStatus = selectedStatus === '' || rowStatus === selectedStatus;
        const matchDate   = selectedDate === '' || rowDate === selectedDate;

        row.style.display =
            (matchSearch && matchStatus && matchDate)
                ? ''
                : 'none';
    });
}

searchInput.addEventListener('keyup', filterTable);
statusFilter.addEventListener('change', filterTable);
dateFilter.addEventListener('change', filterTable);
</script>

@endsection
