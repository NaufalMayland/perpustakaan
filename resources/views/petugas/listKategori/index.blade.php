@extends('petugas.layout.layout')
@section('content')
    <div class="bg-white p-4 rounded shadow-md">
        <div class="flex justify-between items-center">
            <div class="font-bold text-lg w-full">
                <span>Data {{ $title }}</span>
            </div>
            <div class="flex gap-2 text-white text-sm w-full">
                <a href="{{ route('petugas.ListKategori.printListKategori') }}" target="_blank" class="p-2 w-full justify-center rounded bg-blue-900 flex gap-1 items-center hover:bg-blue-950">
                    <i class="fa-solid fa-print"></i>
                    <span>Print</span>
                </a>
                <a href="" class="p-2 w-full justify-center rounded bg-blue-900 flex gap-1 items-center hover:bg-blue-950">
                    <i class="fa-solid fa-file-export"></i>
                    <span>Eksport</span>
                </a>
                <a href="{{ route('petugas.LisKategori.importListKategori') }}" class="p-2 w-full justify-center rounded bg-blue-900 flex gap-1 items-center hover:bg-blue-950">
                    <i class="fa-solid fa-file-import"></i>
                    <span>Import</span>
                </a>
                @include('petugas.listKategori.modal.addListKategori')
                <a href="{{ route('petugas.listKategori.trashListKategori') }}" class="py-2 px-4 justify-center rounded bg-red-500 flex gap-1 items-center hover:bg-red-600">
                    <i class="fa-solid fa-trash-can-arrow-up"></i>
                </a>
            </div>
        </div>
        <div class="mt-4">
            <table class="text-sm" id="listKategoriTable">
                <thead class="w-full">
                    <tr>
                        <td class="p-2 text-center font-bold uppercase bg-slate-200">Cover</td>
                        <td class="p-2 text-center font-bold uppercase bg-slate-200">Buku</td>
                        <td class="p-2 text-center font-bold uppercase bg-slate-200">Kategori</td>
                        <td class="p-2 text-center font-bold uppercase bg-slate-200">option</td>
                    </tr>
                </thead>
                <tbody class="w-full">
                    @foreach ($dataListKategori as $item)
                        <tr>
                            <td class="p-2">
                                <img src="{{ asset('storage/' . $item->buku->cover) }} " class="w-20" alt="cover">
                            </td>
                            <td class="p-2">{{ $item->buku->judul }}</td>
                            <td class="p-2">{{ $item->kategori->kategori }}</td>
                            <td class="p-2">
                                <div class="flex gap-2 justify-center items-center">
                                    <a href="" class="py-1 px-2 rounded text-center bg-blue-500 text-white">
                                        <i class="fa-solid fa-pencil text-sm"></i>
                                    </a>
                                    <form id="deleteListKategori" action="{{ route('petugas.listKategori.deleteListKategori', $item->id) }}" method="POST" class="">
                                        @csrf
                                        @method('DELETE')
                                        <button class="py-1 px-2 rounded text-center bg-red-500 text-white" onclick="deleteListKategori()">
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

    <script>
        $(document).ready( function () {
            $('#listKategoriTable').DataTable();
        } );
    </script>
@endsection