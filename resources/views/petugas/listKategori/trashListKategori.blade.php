@extends('petugas.layout.layout')
@section('content')
    <div class="bg-white p-4 rounded shadow-md">
        <div class="mt-4">
            <table class="text-sm" id="dendaTable">
                <thead class="w-full">
                    <tr>
                        <td class="p-2 text-center font-bold uppercase bg-slate-200">Cover</td>
                        <td class="p-2 text-center font-bold uppercase bg-slate-200">Judul</td>
                        <td class="p-2 text-center font-bold uppercase bg-slate-200">Kategori</td>
                        <td class="p-2 text-center font-bold uppercase bg-slate-200">Option</td>
                    </tr>
                </thead>
                <tbody class="w-full">
                    @foreach ($trash as $item)
                        <tr>
                            <td class="p-2">
                                <img src="{{ asset('storage/' . $item->buku->cover) }}" class="w-20" alt="cover">
                            </td>   
                            <td class="p-2">{{ $item->buku->judul }}</td>
                            <td class="p-2">{{ $item->kategori->kategori }}</td>
                            <td class="p-2">
                                <div class="flex gap-2 justify-center items-center">
                                    <form id="restoreListKategori" action="{{ route('petugas.listKategori.restoreListKategori', $item->id) }}" method="POST" class="">
                                        @csrf
                                        <button class="py-1 px-2 rounded text-center bg-blue-900 hover:bg-blue-950 text-white" onclick="restoreListKategori()">
                                            <i class="fa-solid fa-recycle"></i>  
                                        </button>
                                    </form>
                                    <form id="destroyListKategori" action="{{ route('petugas.listKategori.destroyListKategori', $item->id) }}" method="POST" class="">
                                        @csrf
                                        @method('DELETE')
                                        <button class="py-1 px-2 rounded text-center bg-red-500 hover:bg-red-600 text-white" onclick="destroyListKategori()">
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

    <script>
        $(document).ready( function () {
            $('#dendaTable').DataTable();
            
        } );
    </script>
@endsection