@extends('petugas.layout.layout')
@section('content')
    <div class="bg-white p-4 rounded shadow mt-4">
        <div class="overflow-x-auto">
            <table id="trashBuku" class="min-w-full border border-gray-400 text-sm">
                <thead class="bg-gray-400 w-full">
                    <tr class="text-gray-950">
                        <th class="p-2 text-center font-bold uppercase relative">Cover</th>
                        <th class="p-2 text-center font-bold uppercase relative">Judul</th>
                        <th class="p-2 text-center font-bold uppercase relative">Penulis</th>
                        <th class="p-2 text-center font-bold uppercase relative">Kode</th>
                        <th class="p-2 text-center font-bold uppercase relative">Stok</th>
                        <th class="p-2 text-center font-bold uppercase relative">Option</th>
                    </tr>
                </thead>
                <tbody class="w-full">
                    @foreach ($trash as $item)
                        <tr class="border-b border-gray-400 hover:bg-gray-50">
                            <td class="p-2 flex justify-center">
                                @if (Str::startsWith($item->cover, 'http'))
                                    <img src="{{ $item->cover }}" class="w-20 object-cover rounded" alt="{{ $item->judul }}">
                                @else
                                    <img src="{{ asset('storage/' . $item->cover) }}" class="w-20 object-cover rounded" alt="{{ $item->judul }}">
                                @endif
                            </td>
                            <td class="p-2">{{ $item->judul }}</td>
                            <td class="p-2">{{ $item->penulis }}</td>
                            <td class="p-2">{{ $item->kode }}</td>
                            <td class="p-2">{{ $item->stok }}</td>
                            <td class="p-2">
                                <div class="flex gap-2 justify-center items-center">
                                    <form id="restoreBuku" action="{{ route('petugas.buku.restoreBuku', $item->id) }}" method="POST" class="">
                                        @csrf
                                        <button class="py-1 px-2 rounded text-center bg-blue-900 hover:bg-blue-950 text-white" onclick="restoreBuku()">
                                            <i class="fa-solid fa-recycle"></i>
                                        </button>
                                    </form>
                                    <form id="destroyBuku" action="{{ route('petugas.buku.destroyBuku', $item->id) }}" method="POST" class="">
                                        @csrf
                                        @method('DELETE')
                                        <button class="py-1 px-2 rounded text-center bg-red-500 hover:bg-red-600 text-white" onclick="destroyBuku()">
                                            <i class="fa-solid fa-trash"></i>  
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
            $('#trashBuku').DataTable({
                responsive: true,
                autoWidth: false,
                
            });
        });
    </script>
@endsection