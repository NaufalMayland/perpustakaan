@extends('petugas.layout.layout')
@section('content')
    <div class="bg-white p-4 rounded shadow-md">
        <div class="flex justify-between items-center">
            <div class="font-bold text-lg">
                <span>Data User</span>
            </div>
            <div class="flex gap-2 text-white text-sm">
                <a href="{{route('petugas.user.print')}}" target="_blank" class="py-2 px-3 rounded bg-blue-600 flex gap-1 items-center outline-none hover:outline hover:outline-blue-600 hover:bg-white hover:text-blue-600">
                    <i class="fa-solid fa-print"></i>
                    <span>Print</span>
                </a>
                <a href="" class="py-2 px-3 rounded bg-blue-600 flex gap-1 items-center outline-none hover:outline hover:outline-blue-600 hover:bg-white hover:text-blue-600">
                    <i class="fa-solid fa-file-export"></i>
                    <span>Eksport</span>
                </a>
                <a href="" class="py-2 px-3 rounded bg-blue-600 flex gap-1 items-center outline-none hover:outline hover:outline-blue-600 hover:bg-white hover:text-blue-600">
                    <i class="fa-solid fa-file-import"></i>
                    <span>Import</span>
                </a>
                <a href="{{route('petugas.user.addUser')}}" class="py-2 px-3 rounded bg-blue-600 flex gap-1 items-center outline-none hover:outline hover:outline-blue-600 hover:bg-white hover:text-blue-600">
                    <i class="fa-solid fa-plus"></i>
                    <span>Tambah</span>
                </a>
            </div>
        </div>
    </div>
@endsection