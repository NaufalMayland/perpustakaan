@extends('petugas.layout.layout')
@section('content')
    <div class="bg-white p-4 rounded shadow-md">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-lg">Data {{ $title }}</h2>
            <div class="flex gap-2 text-sm">
                <a href="" target="_blank" class="px-4 py-2 rounded bg-blue-900 text-white flex items-center gap-2 hover:bg-blue-950">
                    <i class="fa-solid fa-print"></i> 
                    <span class="hidden lg:block">Print</span>
                </a>
            </div>
        </div>
    </div>
    <div class="bg-white p-4 rounded shadow-md mt-4">
        <div class="overflow-x-auto">
            <table id="dendaTable" class="min-w-full border border-gray-400 text-sm">
                <thead class="w-full">
                    <tr class="text-gray-950">
                        <th class="p-2 text-center font-bold uppercase relative">Peminjam</th>
                        <th class="p-2 text-center font-bold uppercase relative">Buku Pinjaman</th>
                        <th class="p-2 text-center font-bold uppercase relative">Tanggal Pinjam</th>
                        <th class="p-2 text-center font-bold uppercase relative">Tanggal Kembali</th>
                        <th class="p-2 text-center font-bold uppercase relative">Tanggal Dikembalikan</th>
                        <th class="p-2 text-center font-bold uppercase relative">Jumlah</th>
                        <th class="p-2 text-center font-bold uppercase relative">Status Denda</th>
                        <th class="p-2 text-center font-bold uppercase relative">Option</th>
                    </tr>
                </thead>
                <tbody class="w-full">
                    @foreach ($denda as $item)
                        <tr class="border-b border-gray-400 hover:bg-gray-50">
                            <td class="p-2 text-left">{{ $item->peminjaman->peminjam->nama }}</td>
                            <td class="p-2 text-left">{{ $item->peminjaman->buku->judul }}</td>
                            <td class="p-2 text-left">{{ \Carbon\Carbon::parse($item->peminjaman->tanggal_pinjam)->translatedFormat('j F Y') }}</td>
                            <td class="p-2 text-left">{{ \Carbon\Carbon::parse($item->peminjaman->tanggal_kembali)->translatedFormat('j F Y') }}</td>
                            <td class="p-2 text-left">{{ \Carbon\Carbon::parse($item->peminjaman->tanggal_dikembalikan)->translatedFormat('j F Y') }}</td>
                            <td class="p-2 text-left">{{ $item->peminjaman->jumlah }}</td>
                            <td class="p-2 text-left">{{ $item->status }}</td>
                            <td class="p-2">
                                <div class="flex gap-2 justify-center items-center">
                                    <a href="" class="py-1 px-2 rounded text-center bg-blue-900 hover:bg-blue-950 text-white">
                                        <i class="fa-solid fa-pencil text-sm"></i>
                                    </a>
                                </div>
                            </td>
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
            $('#dendaTable').DataTable({
                responsive: true,
                autoWidth: false,
                
            });
        });
    </script>
@endsection