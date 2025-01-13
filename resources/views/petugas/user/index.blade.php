@extends('petugas.layout.layout')
@section('content')
    <div class="bg-white p-4 rounded shadow-md">
        <div class="flex justify-between items-center">
            <div class="font-bold text-lg w-full">
                <span>Data User</span>
            </div>
            <div class="flex gap-2 text-white text-sm w-full">
                <a href="{{route('petugas.user.printUser')}}" target="_blank" class="p-2 w-full justify-center rounded bg-blue-600 flex gap-1 items-center hover:bg-blue-900">
                    <i class="fa-solid fa-print"></i>
                    <span>Print</span>
                </a>
                <a href="" class="p-2 w-full justify-center rounded bg-blue-600 flex gap-1 items-center hover:bg-blue-900">
                    <i class="fa-solid fa-file-export"></i>
                    <span>Eksport</span>
                </a>
                <a href="{{route('petugas.user.importUser')}}" class="p-2 w-full justify-center rounded bg-blue-600 flex gap-1 items-center hover:bg-blue-900">
                    <i class="fa-solid fa-file-import"></i>
                    <span>Import</span>
                </a>
                <a href="{{route('petugas.user.addUser')}}" class="p-2 w-full justify-center rounded bg-blue-600 flex gap-1 items-center hover:bg-blue-900">
                    <i class="fa-solid fa-plus"></i>
                    <span>Tambah</span>
                </a>
            </div>
        </div>
        <div class="flex w-full mt-6">
            <table class="w-full table-auto rounded text-sm">
                <tr>
                    <td class="p-2 text-center font-bold uppercase bg-slate-200">Username</td>
                    <td class="p-2 text-center font-bold uppercase bg-slate-200">Email</td>
                    <td class="p-2 text-center font-bold uppercase bg-slate-200">Hak akses</td>
                    <td class="p-2 text-center font-bold uppercase bg-slate-200">Option</td>
                </tr>
                @foreach ($dataUser as $data)
                    <tr>
                        <td class="p-2">{{ $data->username }}</td>
                        <td class="p-2">{{ $data->email }}</td>
                        <td class="p-2 capitalize">{{ $data->role->role }}</td>
                        <td class="p-2 flex gap-4">
                            <a href="" class="py-1 rounded w-full text-center bg-blue-500 text-white">Edit</a>
                            <a href="" class="py-1 rounded w-full text-center bg-red-500 text-white">Hapus</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection