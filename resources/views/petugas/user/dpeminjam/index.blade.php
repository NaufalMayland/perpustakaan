@extends('petugas.layout.layout')
@section('content')
    <div class="bg-white p-4 rounded shadow">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-lg">Data {{ $title }}</h2>
            <div class="flex gap-2 text-sm">
                <a href="{{ route('petugas.user.dpeminjam.printPeminjam') }}" target="_blank" class="px-4 py-2 rounded bg-blue-900 text-white flex items-center gap-2 hover:bg-blue-950">
                    <i class="fa-solid fa-print"></i> 
                    <span class="hidden lg:block">Print</span>
                </a>
                <button onclick="openExportModal()" class="px-4 py-2 rounded bg-blue-900 text-white flex items-center gap-2 hover:bg-blue-950">
                    <i class="fa-solid fa-file-export"></i> 
                    <span class="hidden lg:block">Export</span>
                </button>
                <a href="{{ route('petugas.user.dpeminjam.addPeminjam') }}" class="px-4 py-2 rounded bg-blue-900 text-white flex items-center gap-2 hover:bg-blue-950">
                    <i class="fa-solid fa-plus"></i>
                    <span class="hidden lg:block">Tambah</span>
                </a>
                <a href="{{ route('petugas.user.dpeminjam.trashPeminjam') }}" class="px-4 py-2 rounded bg-red-500 text-white flex items-center gap-2 hover:bg-red-600">
                    <i class="fa-solid fa-trash-can-arrow-up"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="bg-white p-4 rounded shadow mt-4">
        <div class="overflow-x-auto">
            <table id="dpeminjamTable" class="min-w-full border border-gray-400 text-sm">
                <thead class="w-full">
                    <tr class="text-gray-950">
                        <th class="p-2 text-center font-bold uppercase relative">Nama</th>
                        <th class="p-2 text-center font-bold uppercase relative">Email</th>
                        <th class="p-2 text-center font-bold uppercase relative">Alamat</th>
                        <th class="p-2 text-center font-bold uppercase relative">Telepon</th>
                        <th class="p-2 text-center font-bold uppercase relative">Option</th>
                    </tr>
                </thead>
                <tbody class="w-full">
                    @foreach ($peminjam as $item)
                    @php
                        $alamat = json_decode($item->alamat, true);
                    @endphp
                        <tr class="border-b border-gray-400 hover:bg-gray-50">
                            <td class="p-2">{{ $item->nama }}</td>
                            <td class="p-2">{{ $item->email }}</td>
                            <td class="p-2">
                                @if ($item->alamat == null)
                                    -
                                @else
                                    {{ $alamat['kelurahan']['name'] }}, {{ $alamat['kecamatan']['name'] }}, {{ $alamat['kabupaten']['name'] }}, {{ $alamat['provinsi']['name'] }}
                                @endif
                            </td>
                            <td class="p-2">{{ $item->telepon ?? "-" }}</td>
                            <td class="p-2">
                                <div class="flex gap-2 justify-center items-center">
                                    <a href="{{ route('petugas.user.dpeminjam.detailPeminjam', $item->id) }}" class="py-1 px-2 rounded text-center bg-blue-900 hover:bg-blue-950 text-white">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <form id="deletePeminjam" action="{{ route('petugas.user.dpeminjam.deletePeminjam', $item->id) }}" method="POST" class="">
                                        @csrf
                                        @method('DELETE')
                                        <button class="py-1 px-2 rounded text-center bg-red-500 hover:bg-red-600 text-white" onclick="deletePeminjam()">
                                            <i class="fa-solid fa-trash text-sm"></i>    
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @if (session('success'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    title: "Berhasil!",
                    text: "{{ session('success') }}",
                    icon: "success",
                    timer: 2000,
                    showConfirmButton: false
                });
            });
        </script>
    @endif
    
    <div id="exportModal" class="hidden">
        <div class="flex items-center justify-center fixed inset-0 bg-gray-900 bg-opacity-50">
            <div class="bg-white p-4 rounded-lg w-80 text-sm">
                <h3 class="text-lg font-semibold mb-4">Pilih Format Export</h3>
                <form method="GET" action="{{ route('petugas.user.dpeminjam.exportPeminjam') }}">
                    @csrf
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
        $(document).ready(function() {
            $('#dpeminjamTable').DataTable({
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