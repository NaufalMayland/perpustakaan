@extends('petugas.layout.layout')
@section('content')
    <div class="bg-white p-4 rounded shadow">
        <div class="flex justify-between items-center">
            <div class="flex gap-2 items-center">
                <h2 class="font-semibold text-lg">Data {{ $title }}</h2>
                <form action="{{ route('petugas.riwayatPeminjaman.index') }}" method="GET" id="filterPeminjaman">
                    @csrf
                    <select name="filterBulan" id="filterBulan" class="capitalize border border-neutral-500 p-1 bg-white rounded focus:outline-none" onchange="this.form.submit()">
                        <option value="semua" {{ request('filterBulan') == 'semua' ? 'selected' : '' }}>Semua</option>
                        <option value="{{ now()->month }}" {{ request('filterBulan') == now()->month ? 'selected' : '' }}>Bulan Ini</option>
                        <option value="{{ now()->subMonth()->month }}" {{ request('filterBulan') == now()->subMonth()->month ? 'selected' : '' }}>Bulan Kemarin</option>
                    </select>
                </form>
            </div>
            <div class="flex gap-2 text-sm">
                <a href="{{ route('petugas.riwayatPeminjaman.printRiwayatPeminjaman', ['filterBulan' => request('filterBulan', 'semua')]) }}" target="_blank" 
                    class="px-4 py-2 rounded bg-blue-900 text-white flex items-center gap-2 hover:bg-blue-950">
                     <i class="fa-solid fa-print"></i> 
                     <span class="hidden lg:block">Print</span>
                 </a>
                 
                <button onclick="openExportModal()" class="px-4 py-2 rounded bg-blue-900 text-white flex items-center gap-2 hover:bg-blue-950">
                    <i class="fa-solid fa-file-export"></i> 
                    <span class="hidden lg:block">Export</span>
                </button>
            </div>
        </div>
    </div>
    <div class="bg-white p-4 rounded shadow mt-4">
        <div class="overflow-x-auto w-full">
            <table id="riwayatPeminjamanTable" class="min-w-full table-auto border border-gray-400 text-sm">
                <thead class="w-full">
                    <tr class="text-gray-950">
                        <th class="p-2 text-center font-bold uppercase">Peminjam</th>
                        <th class="p-2 text-center font-bold uppercase">Buku</th>
                        <th class="p-2 text-center font-bold uppercase">Jumlah</th>
                        <th class="p-2 text-center font-bold uppercase">Tanggal Pinjam</th>
                        <th class="p-2 text-center font-bold uppercase">Tanggal Kembali</th>
                        <th class="p-2 text-center font-bold uppercase">Tanggal Dikembalikan</th>
                        <th class="p-2 text-center font-bold uppercase">Perpanjangan</th>
                        <th class="p-2 text-center font-bold uppercase">Status</th>
                        {{-- <th class="p-2 text-center font-bold uppercase">Denda</th> --}}
                    </tr>
                </thead>
                <tbody class="w-full">
                    @foreach ($riwayatPeminjaman as $item)
                        <tr class="border-b border-gray-400 hover:bg-gray-50">
                            <td class="p-2 text-left">{{ $item->peminjam->nama }}</td>
                            <td class="p-2 text-left">{{ $item->buku->judul }}</td>
                            <td class="p-2 text-left">{{ $item->jumlah }}</td>
                            <td class="p-2 text-left">{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->translatedFormat('j F Y') }}</td>
                            <td class="p-2 text-left">{{ \Carbon\Carbon::parse($item->tanggal_kembali)->translatedFormat('j F Y') }}</td>
                            <td class="p-2 text-left">{{ $item->tanggal_dikembalikan ? \Carbon\Carbon::parse($item->tanggal_dikembalikan)->translatedFormat('j F Y') : "-" }}</td>
                            <td class="p-2 text-left">{{ $item->perpanjangan ? $item->perpanjangan." Hari" : "-"}}</td>
                            <td class="p-2 text-left capitalize">{{ $item->status }}</td>
                            {{-- <td class="p-2 text-left capitalize">{{ $hasDenda ? "Ya" : "Tidak" }}</td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div id="exportModal" class="hidden">
        <div class="flex items-center justify-center fixed inset-0 bg-gray-900 bg-opacity-50">
            <div class="bg-white p-4 rounded-lg w-80 text-sm">
                <h3 class="text-lg font-semibold mb-4">Pilih Format Export</h3>
                <form method="GET" action="{{ route('petugas.riwayatPeminjaman.exportRiwayatPeminjaman') }}">
                    @csrf
                    <input type="hidden" name="filterBulan" id="filterBulanExport" value="{{ request('filterBulan', 'semua') }}">
                
                    <select name="format" class="w-full p-2 rounded border">
                        <option value="pdf">PDF</option>
                        <option value="excel">Excel</option>
                    </select>
                    
                    <div class="flex justify-between mt-4 gap-2">
                        <button type="button" onclick="closeExportModal()" class="px-4 py-2 bg-neutral-500 hover:bg-neutral-600 text-white rounded-full">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-blue-900 hover:bg-blue-950 text-white rounded-full">Export</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .dataTables_wrapper .dataTables_filter, 
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate {
            font-size: 0.25rem !important; 
        }

        th {
            text-align: left !important;    
        }
    </style>

    <script>
        function exportData(format) {
            let bulan = document.getElementById('filterBulan').value;
            window.location.href = "{{ route('petugas.riwayatPeminjaman.exportRiwayatPeminjaman') }}?format=" + format + "&filterBulan=" + bulan;
        }
        
        $(document).ready(function() {
            $('#riwayatPeminjamanTable').DataTable({
                responsive: true,
                autoWidth: false,
            });
        });

        function openExportModal() {
            document.getElementById('exportModal').classList.remove('hidden');
        }

        function closeExportModal() {
            document.getElementById('exportModal').classList.add('hidden');
        }
    </script>
@endsection