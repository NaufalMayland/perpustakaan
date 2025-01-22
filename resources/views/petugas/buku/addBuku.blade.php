@extends('petugas.layout.layout')
@section('content')
    <form method="POST" action="" class="bg-white p-4 shadow-md rounded">
        @csrf
        @if ($errors->any())
            <div class="bg-red-500 text-white text-sm p-3 rounded text-center w-full">
                <ul>
                    @foreach ($errors->all() as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="grid grid-cols-2 gap-4 text-sm mt-4">
            <div class="grid">
                <label for="judul">Judul Buku</label>
                <input type="text" name="judul" id="judul" class="w-full h-9 px-2 rounded bg-gray-100 border-gray-200 text-sm" value="{{ old('judul') }}" required>
            </div>
            <div class="grid">
                <label for="penulis">Penulis</label>
                <input type="text" name="penulis" id="penulis" class="w-full h-9 px-2 rounded bg-gray-100 border-gray-200 text-sm" value="{{ old('penulis') }}" required>
            </div>
            <div class="grid">
                <label for="penerbit">Penerbit</label>
                <input type="text" name="penerbit" id="penerbit" class="w-full h-9 px-2 rounded bg-gray-100 border-gray-200 text-sm" required>
            </div>
            <div class="grid">
                <label for="deskripsi">Deskripsi</label>
                <input type="text" name="deskripsi" id="deskripsi" class="w-full h-9 px-2 rounded bg-gray-100 border-gray-200 text-sm" required>
            </div>
            <div class="grid">
                <label for="tahun_terbit">Tahun Terbit</label>
                <input type="date" name="tahun_terbit" id="tahun_terbit" class="w-full h-9 px-2 rounded bg-gray-100 border-gray-200 text-sm" required>
            </div>
            <div class="grid">
                <label for="kode">Kode</label>
                <input type="text" name="kode" id="kode" class="w-full h-9 px-2 rounded bg-gray-100 border-gray-200 text-sm" required>
            </div>
            <div class="grid">
                <label for="stok">Stok</label>
                <input type="number" name="stok" id="stok" class="w-full h-9 px-2 rounded bg-gray-100 border-gray-200 text-sm" required>
            </div>
        </div>
        <div class="flex justify-end mt-4">
            <button class="bg-blue-900 py-2 px-3 text-sm rounded text-white">Tambah</button>
        </div>
    </form>
@endsection