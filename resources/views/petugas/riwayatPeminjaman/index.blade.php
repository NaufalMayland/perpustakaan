@extends('petugas.layout.layout')
@section('content')
    <div class="bg-white p-4 rounded shadow-md">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-lg">Data {{ $title }}</h2>
            <div class="flex gap-2 text-sm">
                <a href="#" target="_blank" class="px-4 py-2 rounded bg-blue-900 text-white flex items-center gap-2 hover:bg-blue-950">
                    <i class="fa-solid fa-print"></i> 
                    <span class="hidden lg:block">Print</span>
                </a>
                <a href="#" class="px-4 py-2 rounded bg-blue-900 text-white flex items-center gap-2 hover:bg-blue-950">
                    <i class="fa-solid fa-file-export"></i> 
                    <span class="hidden lg:block">Export</span>
                </a>
            </div>
        </div>
    </div>
    <div class="bg-white p-4 rounded shadow-md mt-4">
        <div class="overflow-x-auto w-full">
            <table id="riwayatPeminjamanTable" class="min-w-full table-auto border border-gray-400 text-sm">
                <thead class="w-full">
                    <tr class="text-gray-950">
                        <th class="p-2 text-center font-bold uppercase">Peminjam</th>
                        <th class="p-2 text-center font-bold uppercase">Buku</th>
                        <th class="p-2 text-center font-bold uppercase">Jumlah</th>
                        <th class="p-2 text-center font-bold uppercase">Tanggal Peminjaman</th>
                        <th class="p-2 text-center font-bold uppercase">Tanggal Pengembalian</th>
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
    $(document).ready(function() {
        $('#riwayatPeminjamanTable').DataTable({
            responsive: true,
            autoWidth: false,
        });
    });
</script>
@endsection