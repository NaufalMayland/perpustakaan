@extends('petugas.layout.layout')
@section('content')
    <div class="bg-white p-4 rounded shadow mt-4">
        <div class="overflow-x-auto">
            <table id="ulasanTable" class="min-w-full border border-gray-400 text-sm">
                <thead class="w-full">
                    <tr class="text-gray-950">
                        <th class="p-2 text-center font-bold uppercase relative">Cover</th>
                        <th class="p-2 text-center font-bold uppercase relative">Judul</th>
                        <th class="p-2 text-center font-bold uppercase relative">Kategori</th>
                        <th class="p-2 text-center font-bold uppercase relative">Option</th>
                    </tr>
                </thead>
                <tbody class="w-full">
                    @foreach ($buku as $item)
                        <tr class="border-b border-gray-400 hover:bg-gray-50">
                            <td class="p-2 flex justify-center">
                                @if (Str::startsWith($item->buku->cover, 'http'))
                                    <img src="{{ $item->buku->cover }}" class="w-20 object-cover rounded" alt="{{ $item->buku->judul }}">
                                @else
                                    <img src="{{ asset('storage/' . $item->buku->cover) }}" class="w-20 object-cover rounded" alt="{{ $item->buku->judul }}">
                                @endif
                            </td>
                            <td class="p-2">{{ $item->buku->judul }}</td>
                            <td class="p-2 capitalize">{{ $item->kategori->kategori }}</td>
                            <td class="p-2">
                                <div class="flex gap-2 justify-center items-center">
                                    <a href="{{ route('petugas.ulasan.detailUlasan', $item->buku->slug) }}" class="py-1 px-2 rounded text-center bg-blue-900 hover:bg-blue-950 text-white">
                                        <i class="fa-solid fa-eye text-sm"></i>
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
            $('#ulasanTable').DataTable({
                responsive: true,
                autoWidth: false,
            });
        });
    </script>
@endsection
