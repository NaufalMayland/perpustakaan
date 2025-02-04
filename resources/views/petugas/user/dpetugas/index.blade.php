@extends('petugas.layout.layout')
@section('content')
    <div class="bg-white p-4 rounded shadow-md">
        <div class="flex justify-between items-center">
            <div class="font-bold text-lg w-full">
                <span>Data {{ $title }}</span>
            </div>
            <div class="flex gap-2 text-white text-sm w-full">
                <a href="{{ route('petugas.user.dpetugas.printPetugas') }}" target="_blank" class="p-2 w-full justify-center rounded bg-blue-900 flex gap-1 items-center hover:bg-blue-950">
                    <i class="fa-solid fa-print"></i>
                    <span>Print</span>
                </a>
                <a href="" class="p-2 w-full justify-center rounded bg-blue-900 flex gap-1 items-center hover:bg-blue-950">
                    <i class="fa-solid fa-file-export"></i>
                    <span>Eksport</span>
                </a>
                <a href="{{ route('petugas.user.dpetugas.importPetugas') }}" class="p-2 w-full justify-center rounded bg-blue-900 flex gap-1 items-center hover:bg-blue-950">
                    <i class="fa-solid fa-file-import"></i>
                    <span>Import</span>
                </a>
                <a href="{{ route('petugas.user.dpetugas.addPetugas') }}" class="p-2 w-full justify-center rounded bg-blue-900 flex gap-1 items-center hover:bg-blue-950">
                    <i class="fa-solid fa-plus"></i>
                    <span>Tambah</span>
                </a>
                <a href="{{ route('petugas.user.dpetugas.trashPetugas') }}" class="py-2 px-4 justify-center rounded bg-red-500 flex gap-1 items-center hover:bg-red-600">
                    <i class="fa-solid fa-trash-can-arrow-up"></i>
                </a>
            </div>
        </div>
        <div class="mt-4">
            <table class="text-sm" id="dendaTable">
                <thead class="w-full">
                    <tr>
                        <td class="p-2 text-center font-bold uppercase bg-slate-200">Username</td>
                        <td class="p-2 text-center font-bold uppercase bg-slate-200">Email</td>
                        <td class="p-2 text-center font-bold uppercase bg-slate-200">Telepon</td>
                        <td class="p-2 text-center font-bold uppercase bg-slate-200">Hak Akses</td>
                        <td class="p-2 text-center font-bold uppercase bg-slate-200">Option</td>
                    </tr>
                </thead>
                <tbody class="w-full">
                    @foreach ($petugas as $item)
                        <tr>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->telepon }} @if ($item->telepon == null) - @endif</td>
                            <td>{{ $item->role }}</td>
                            <td class="p-2">
                                <div class="flex gap-2 justify-center items-center">
                                    <a href="" class="py-1 px-2 rounded text-center bg-blue-900 hover:bg-blue-950 text-white">
                                        <i class="fa-solid fa-eye text-sm"></i>
                                    </a>
                                    <a href="" class="py-1 px-2 rounded text-center bg-blue-900 hover:bg-blue-950 text-white">
                                        <i class="fa-solid fa-pencil text-sm"></i>
                                    </a>
                                    <form id="deletePetugas" action="{{ route('petugas.user.dpetugas.deletePetugas', $item->id) }}" method="POST" class="">
                                        @csrf
                                        @method('DELETE')
                                        <button class="py-1 px-2 rounded text-center bg-red-500 hover:bg-red-600 text-white" onclick="deletePetugas()">
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
            $('#dendaTable').DataTable();
            
        } );
    </script>
@endsection