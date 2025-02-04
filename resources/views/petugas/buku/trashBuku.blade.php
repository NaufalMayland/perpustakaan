@extends('petugas.layout.layout')
@section('content')
    <div class="bg-white p-4 rounded shadow-md">
        <div class="mt-4">
            <table class="text-sm" id="dendaTable">
                <thead class="w-full">
                    <tr>
                        <td class="p-2 text-center font-bold uppercase bg-slate-200">Cover</td>
                        <td class="p-2 text-center font-bold uppercase bg-slate-200">Judul</td>
                        <td class="p-2 text-center font-bold uppercase bg-slate-200">Penulis</td>
                        <td class="p-2 text-center font-bold uppercase bg-slate-200">Kode</td>
                        <td class="p-2 text-center font-bold uppercase bg-slate-200">Stok</td>
                        <td class="p-2 text-center font-bold uppercase bg-slate-200">Option</td>
                    </tr>
                </thead>
                <tbody class="w-full">
                    @foreach ($trash as $item)
                        <tr>
                            <td class="p-2">
                                <img src="{{ asset('storage/' . $item->cover) }}" class="w-20" alt="cover">
                            </td>   
                            <td class="p-2">{{ $item->judul }}</td>
                            <td class="p-2">{{ $item->penulis }}</td>
                            <td class="p-2">{{ $item->kode }}</td>
                            <td class="p-2">{{ $item->stok }}</td>
                            <td class="p-2">
                                <div class="flex gap-2 justify-center items-center">
                                    <form id="restoreBuku" action="{{ route('petugas.buku.restoreBuku', $item->id) }}" method="POST" class="">
                                        @csrf
                                        <button class="py-1 px-2 rounded text-center bg-red-500 text-white" onclick="restoreBuku()">
                                            <i class="fa-solid fa-trash-can-arrow-up"></i>  
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