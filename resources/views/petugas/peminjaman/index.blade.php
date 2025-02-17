@extends('petugas.layout.layout')
@section('content')
    <div class="bg-white p-4 rounded shadow-md">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-lg">Data {{ $title }}</h2>
            <div class="flex gap-2 text-sm">
                <a href="{{ route('petugas.peminjaman.printPeminjaman') }}" target="_blank" class="px-4 py-2 rounded bg-blue-900 text-white flex items-center gap-2 hover:bg-blue-950">
                    <i class="fa-solid fa-print"></i> 
                    <span class="hidden lg:block">Print</span>
                </a>
                <a href="#" class="px-4 py-2 rounded bg-blue-900 text-white flex items-center gap-2 hover:bg-blue-950">
                    <i class="fa-solid fa-file-export"></i> 
                    <span class="hidden lg:block">Export</span>
                </a>
                <a href="{{ route('petugas.peminjaman.importPeminjaman') }}" class="px-4 py-2 rounded bg-blue-900 text-white flex items-center gap-2 hover:bg-blue-950">
                    <i class="fa-solid fa-file-import"></i> 
                    <span class="hidden lg:block">Import</span>
                </a>
                <a href="{{ route('petugas.peminjaman.addPeminjaman') }}" class="px-4 py-2 rounded bg-blue-900 text-white flex items-center gap-2 hover:bg-blue-950">
                    <i class="fa-solid fa-plus"></i>
                    <span class="hidden lg:block">Tambah</span>
                </a>
                <a href="" class="px-4 py-2 rounded bg-red-500 text-white flex items-center gap-2 hover:bg-red-600">
                    <i class="fa-solid fa-trash-can-arrow-up"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="bg-white p-4 rounded shadow-md mt-4">
        <div class="overflow-x-auto">
            <table id="peminjamanTable" class="min-w-full border border-gray-400 text-sm">
                <thead class="bg-gray-400 w-full">
                    <tr class="text-gray-950">
                        <th class="p-2 text-center font-bold uppercase">Peminjam</th>
                        <th class="p-2 text-center font-bold uppercase">Buku</th>
                        <th class="p-2 text-center font-bold uppercase">Petugas</th>
                        <th class="p-2 text-center font-bold uppercase">Jumlah</th>
                        <th class="p-2 text-center font-bold uppercase">Tanggal Peminjaman</th>
                        <th class="p-2 text-center font-bold uppercase">Tanggal Pengembalian</th>
                        <th class="p-2 text-center font-bold uppercase">Tanggal Dikembalikan</th>
                        <th class="p-2 text-center font-bold uppercase">Status</th>
                        <th class="p-2 text-center font-bold uppercase">Option</th>
                    </tr>
                </thead>
                <tbody class="w-full">
                    {{-- @foreach ($dataBuku as $item) --}}
                        <tr class="border-b border-gray-400 hover:bg-gray-50">
                            <td class="p-2 text-left">...</td>
                            <td class="p-2 text-left">...</td>
                            <td class="p-2 text-left">...</td>
                            <td class="p-2 text-left">...</td>
                            <td class="p-2 text-left">...</td>
                            <td class="p-2 text-left">...</td>
                            <td class="p-2 text-left">...</td>
                            <td class="p-2 text-left">...</td>
                            <td class="p-2">
                                <div class="flex gap-2 justify-center items-center">
                                    <a href="" class="py-1 px-2 rounded text-center bg-blue-900 hover:bg-blue-950 text-white">
                                        <i class="fa-solid fa-pencil text-sm"></i>
                                    </a>
                                    <form id="deleteBuku" action="" method="POST" class="">
                                        @csrf
                                        @method('DELETE')
                                        <button class="py-1 px-2 rounded text-center bg-red-500 hover:bg-red-600 text-white" onclick="deleteBuku()">
                                            <i class="fa-solid fa-trash text-sm"></i>    
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    {{-- @endforeach --}}
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
            $('#peminjamanTable').DataTable({
                responsive: true,
                autoWidth: false,
                
            });
        });
    </script>
@endsection