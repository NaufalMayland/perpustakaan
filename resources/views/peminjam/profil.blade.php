@extends('peminjam.layout.layout')
@section('content')
    <div class="flex flex-col lg:flex-row gap-8 items-start">
        <div class="w-full lg:w-1/4 flex justify-center">
            <img src="" alt="Cover Buku" class="w-full rounded bg-cover">
        </div>
        <div class="w-full lg:w-3/4 flex flex-col gap-4  lg:text-base">
            <div class="grid">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" class="w-full p-2 rounded border bg-gray-100 border-gray-300 focus:outline-none" value="{{ $peminjam->nama }}" readonly>
            </div>
            <div class="grid">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" class="w-full p-2 rounded border bg-gray-100 border-gray-300 focus:outline-none" value="{{ $peminjam->email }}" readonly>
            </div>
            <div class="grid">
                <label for="alamat">Alamat</label>
                <input type="text" name="alamat" id="alamat" class="w-full p-2 rounded border bg-gray-100 border-gray-300 focus:outline-none" value="{{ $peminjam->alamat ?? "-"}}" readonly>
            </div>
            <div class="grid">
                <label for="telepon">Telepon</label>
                <input type="text" name="telepon" id="telepon" min="1800" max="2100" class="w-full p-2 rounded border bg-gray-100 border-gray-300 focus:outline-none" value="{{ $peminjam->telepon ?? "-"}}" readonly>
            </div>
            
            <div class="justify-between flex w-full items-center">
                <div class="flex flex-row mt-2 gap-4 items-center text-sm">
                    <a href="#" class="bg-blue-900 hover:bg-blue-950 text-white flex w-full items-center gap-2 py-2 px-4 rounded">
                        <i class="fa-solid fa-arrow-left text-sm"></i>
                        <span>Exit</span>
                    </a>
                </div>
                <div class="flex flex-row mt-2 gap-4 items-center text-sm">
                    <a href="#" class="bg-blue-900 hover:bg-blue-950 text-white flex w-full items-center gap-2 py-2 px-4 rounded">
                        <i class="fa-solid fa-pencil text-sm"></i>
                        <span>Edit</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
