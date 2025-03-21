@extends('petugas.layout.layout')
@section('content')
    <div class="bg-white p-4 rounded shadow mt-4">
        <div class="overflow-x-auto">
            <table id="trashKategori" class="min-w-full border border-gray-400 text-sm">
                <thead class="bg-gray-400 w-full">
                    <tr class="text-gray-950">
                        <th class="p-2 text-center font-bold uppercase relative">Kategori</th>
                        <th class="p-2 text-center font-bold uppercase relative">Option</th>
                    </tr>
                </thead>
                <tbody class="w-full">
                    @foreach ($trash as $item)
                        <tr class="border-b border-gray-400 hover:bg-gray-50">
                            <td class="p-2 capitalize">{{ $item->kategori }}</td>
                            <td class="p-2">
                                <div class="flex gap-2 justify-center items-center">
                                    <form id="restoreKategori" action="{{ route('petugas.kategori.restoreKategori', $item->id) }}" method="POST" class="">
                                        @csrf
                                        <button class="py-1 px-2 rounded text-center bg-blue-900 hover:bg-blue-950 text-white" onclick="restoreKategori()">
                                            <i class="fa-solid fa-recycle"></i>
                                        </button>
                                    </form>
                                    <form id="destroyKategori" action="{{ route('petugas.kategori.destroyKategori', $item->id) }}" method="POST" class="">
                                        @csrf
                                        @method('DELETE')
                                        <button class="py-1 px-2 rounded text-center bg-red-500 hover:bg-red-600 text-white" onclick="destroyKategori()">
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
            $('#trashKategori').DataTable({
                responsive: true,
                autoWidth: false,
                
            });
        });
    </script>
@endsection