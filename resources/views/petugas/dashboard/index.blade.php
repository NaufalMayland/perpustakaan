@extends('petugas.layout.layout')
@section('content')
    <div class="gap-4 grid">
        <div class="grid grid-cols-3 justify-between items-center gap-4">
            <a href="{{ route('petugas.buku.index') }}" class="bg-white border-r-2 grid gap-2 items-end border-red-600 rounded shadow p-4">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-book text-blue-900"></i>
                    <span>Data Buku</span>
                </div>
                <div class="flex items-center justify-center">
                    <span class="text-xl font-bold">{{ $buku->count() }}</span>
                </div>
            </a>
            <a href="{{ route('petugas.kategori.index') }}" class="bg-white border-r-2 grid gap-2 items-end border-yellow-500 rounded shadow p-4">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-tags text-blue-900"></i>
                    <span>Data Kategori</span>
                </div>
                <div class="flex items-center justify-center">
                    <span class="text-xl font-bold">22</span>
                </div>
            </a>
            <a href="{{ route('petugas.peminjaman.index') }}" class="bg-white border-r-2 grid gap-2 items-end border-green-600 rounded shadow p-4">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-handshake text-blue-900"></i>
                    <span>Data Peminjaman</span>
                </div>
                <div class="flex items-center justify-center">
                    <span class="text-xl font-bold">{{ $peminjaman->count() }}</span>
                </div>
            </a>
        </div>
        <div class="bg-white rounded flex w-full shadow p-4">
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Corporis necessitatibus nobis optio magnam minus quas, porro exercitationem sed dolor tempore quia quidem rem? Natus alias est cumque tenetur ea laudantium?
        </div>
    </div>
@endsection