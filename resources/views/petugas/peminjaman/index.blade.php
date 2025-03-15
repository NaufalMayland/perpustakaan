@extends('petugas.layout.layout')
@section('content')
    <div class="bg-white p-4 rounded shadow">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-lg">Data {{ $title }}</h2>
            <div class="flex gap-2 text-sm">
                <a href="{{ route('petugas.peminjaman.printPeminjaman') }}" target="_blank" class="px-4 py-2 rounded bg-blue-900 text-white flex items-center gap-2 hover:bg-blue-950">
                    <i class="fa-solid fa-print"></i> 
                    <span class="hidden lg:block">Print</span>
                </a>
                <button onclick="openExportModal()" class="px-4 py-2 rounded bg-blue-900 text-white flex items-center gap-2 hover:bg-blue-950">
                    <i class="fa-solid fa-file-export"></i> 
                    <span class="hidden lg:block">Export</span>
                </button>
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
    <div class="bg-white p-4 rounded shadow mt-4">
        <div class="overflow-x-auto">
            <table id="peminjamanTable" class="min-w-full lg:w-full table-auto border border-gray-400 text-sm">
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
                    </tr>
                </thead>
                <tbody class="w-full">
                    @foreach ($peminjaman as $item)
                        <tr class="border-b border-gray-400 hover:bg-gray-50">
                            <td class="p-2 text-left">{{ $item->peminjam->nama }}</td>
                            <td class="p-2 text-left">{{ $item->buku->judul }}</td>
                            <td class="p-2 text-left">{{ $item->jumlah }}</td>
                            <td class="p-2 text-left">{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->translatedFormat('j F Y') }}</td>
                            <td class="p-2 text-left">{{ \Carbon\Carbon::parse($item->tanggal_kembali)->translatedFormat('j F Y') }}</td>
                            <td class="p-2 text-left">{{ $item->tanggal_dikembalikan ? \Carbon\Carbon::parse($item->tanggal_dikembalikan)->translatedFormat('j F Y') : "-" }}</td>
                            <td class="p-2 text-left">{{ $item->perpanjangan ? $item->perpanjangan." Hari" : "-"}}</td>
                            <td class="p-2 text-left">
                                @if ($item->status == "dibatalkan")
                                    <form action="{{ route('petugas.peminjaman.destroyPeminjaman', $item->id) }}" method="POST" class="flex gap-2 items-center justify-center">
                                        @csrf
                                        @method('DELETE')
                                        <div class="">
                                            <span class="text-red-600 rounded p-2">Pembatalan</span>
                                        </div>
                                        <div class="">
                                            <button type="submit" class="fa-solid fa-check text-white bg-blue-900 hover:bg-blue-950 rounded p-2"></button>
                                        </div>
                                    </form>
                                @elseif($item->status == "menunggu perpanjangan")
                                    <form action="{{ route('petugas.peminjaman.perpanjangan', $item->id) }}" method="POST" class="flex gap-2 items-center justify-center">
                                        @csrf
                                        @method('PUT')
                                        <div class="">
                                            <span class="text-blue-900 rounded p-2">{{ 'Perpanjang '. $item->perpanjangan .' Hari'  }}</span>
                                        </div>
                                        <div class="">
                                            <button type="submit" class="fa-solid fa-check text-white bg-blue-900 hover:bg-blue-950 rounded p-2"></button>
                                        </div>
                                    </form>
                                @else
                                    <form action="{{ route('petugas.peminjaman.editStatusPeminjaman', $item->id) }}" method="POST" id="form-status-{{ $item->id }}" class="flex gap-2 justify-center items-center">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" id="status-{{ $item->id }}" class="capitalize border border-neutral-500 p-1 bg-white rounded focus:outline-none" 
                                            data-id="{{ $item->id }}">
                                            <option class="capitalize" value="proses" {{ $item->status == 'proses' ? 'selected' : '' }}>proses</option>
                                            <option class="capitalize" value="siap diambil" {{ $item->status == 'siap diambil' ? 'selected' : '' }}>siap diambil</option>
                                            <option class="capitalize" value="dipinjam" {{ $item->status == 'dipinjam' ? 'selected' : '' }}>dipinjam</option>
                                            <option class="capitalize" value="diperpanjang" {{ $item->status == 'diperpanjang' ? 'selected' : '' }} disable hidden>diperpanjang</option>
                                            <option class="capitalize" value="dikembalikan" {{ $item->status == 'dikembalikan' ? 'selected' : '' }}>dikembalikan</option>
                                        </select>
                                    </form>
                                @endif
                            </td>
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
                <form method="GET" action="{{ route('petugas.peminjaman.exportPeminjaman') }}">
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

    <div id="dendaModal" class="hidden">
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full flex justify-center items-center">
            <div class="bg-white p-5 rounded-md shadow-lg w-96">
                <div class="text-center">
                    <h3 class="text-lg font-medium text-gray-900">Apakah ada denda?</h3>
                    <div class="mt-4">
                        <form id="dendaForm" action="" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="peminjaman_id" id="peminjaman_id">
                            <input type="text" name="status" value="dikembalikan" hidden>
                            <div class="flex justify-start mb-4 gap-2">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="denda" value="ya" class="form-radio" onchange="toggleDendaInput(this)">
                                    <span class="ml-2">Ya</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="denda" value="tidak" class="form-radio" onchange="toggleDendaInput(this)">
                                    <span class="ml-2">Tidak</span>
                                </label>
                            </div>
                            <div id="dendaInput" class="hidden mb-4">
                                <input type="text" name="status_denda" placeholder="Masukkan status denda" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            </div>
                            <div class="flex justify-between">
                                <button type="button" class="bg-gray-500 text-white px-3 py-2 rounded-full mr-2" onclick="closeModal()">Batal</button>
                                <button type="submit" class="bg-blue-900 text-white px-3 py-2 rounded-full">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
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
            $('#peminjamanTable').DataTable({
                responsive: true,
                autoWidth: false,
            });

            $('select[name="status"]').change(function() {
                if ($(this).val() === 'dikembalikan') {
                    const peminjamanId = $(this).data('id');

                    $('#dendaForm').attr('action', $(this).closest('form').attr('action'));

                    $('#dendaForm').append(`<input type="hidden" name="peminjaman_id" value="${peminjamanId}">`);

                    $('#dendaModal').removeClass('hidden');
                } else {
                    $(this).closest('form').submit();
                }
            });
        });

        function toggleDendaInput(radio) {
            if (radio.value === 'ya') {
                $('#dendaInput').removeClass('hidden');
            } else {
                $('#dendaInput').addClass('hidden');
            }
        }

        function closeModal() {
            $('#dendaModal').addClass('hidden');
        }
        
        function openExportModal() {
            document.getElementById('exportModal').classList.remove('hidden');
        }

        function closeExportModal() {
            document.getElementById('exportModal').classList.add('hidden');
        }
    </script>
@endsection