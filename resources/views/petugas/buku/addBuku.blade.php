@extends('petugas.layout.layout')
@section('content')
    <form method="POST" action="{{ route('petugas.buku.addBukuAction') }}" class="bg-white p-4 shadow-md rounded">
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
                <input type="text" name="judul" id="judul" class="w-full py-2 px-2 rounded border bg-gray-100 border-gray-300 text-sm" value="{{ old('judul') }}" required>
            </div>
            <div class="grid">
                <label for="penulis">Penulis</label>
                <input type="text" name="penulis" id="penulis" class="w-full py-2 px-2 rounded border bg-gray-100 border-gray-300 text-sm" value="{{ old('penulis') }}" required>
            </div>
            <div class="grid">
                <label for="penerbit">Penerbit</label>
                <input type="text" name="penerbit" id="penerbit" class="w-full py-2 px-2 rounded border bg-gray-100 border-gray-300 text-sm" value="{{ old('penerbit') }}" required>
            </div>
            <div class="grid">
                <label for="tahun_terbit">Tahun Terbit</label>
                <input type="date" name="tahun_terbit" id="tahun_terbit" class="w-full py-2 px-2 rounded border bg-gray-100 border-gray-300 text-sm" value="{{ old('tahun_terbit') }}" required>
            </div>
            <div class="grid">
                <label for="kode">Kode</label>
                <input type="text" name="kode" id="kode" class="w-full py-2 px-2 rounded border bg-gray-100 border-gray-300 text-sm" value="{{ old('kode') }}"  required>
            </div>
            <div class="grid">
                <label for="stok">Stok</label>
                <input type="number" name="stok" id="stok" class="w-full py-2 px-2 rounded border bg-gray-100 border-gray-300 text-sm" value="{{ old('stok') }}" required>
            </div>
        </div>
        <div class="grid text-sm mt-4">
            <label for="cover">Cover Buku</label>
            <input type="file" name="cover" id="cover" class="w-full rounded border bg-gray-100 border-gray-300 text-sm cursor-pointer file:cursor-pointer file:mr-2 file:py-2 file:text-sm file:rounded-l file:bg-blue-900 file:text-white file:border-none">
        </div>
        <div class="grid text-sm mt-4">
            <label for="deskripsi">Deskripsi Buku</label>
            <textarea name="deskripsi" id="deskripsi" cols="" rows="3" class="border-gray-300 border bg-gray-100 rounded p-2" value="{{ old('deskripsi') }}" required></textarea>
        </div>
        <div class="flex justify-end mt-4">
            <button class="bg-blue-900 py-2 px-3 text-sm rounded text-white">Tambah</button>
        </div>
    </form>
@endsection