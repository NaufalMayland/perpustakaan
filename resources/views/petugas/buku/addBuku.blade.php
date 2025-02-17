@extends('petugas.layout.layout')
@section('content')
    <form method="POST" action="{{ route('petugas.buku.addBukuAction') }}" class="bg-white p-4 shadow-md rounded" enctype="multipart/form-data">
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
        <div class="grid gap-2 text-sm mt-4">
            <div class="grid">
                <label class="mb-1" for="judul">Judul Buku</label>
                <input type="text" name="judul" id="judul" class="w-full p-2 rounded border bg-gray-100 border-gray-300 text-sm" value="{{ old('judul') }}" placeholder="Masukan judul buku" autocomplete="off" required>
            </div>
            <div class="grid">
                <label class="mb-1" for="penulis">Penulis</label>
                <input type="text" name="penulis" id="penulis" class="w-full p-2 rounded border bg-gray-100 border-gray-300 text-sm" value="{{ old('penulis') }}" placeholder="Masukan penulis" autocomplete="off" required>
            </div>
            <div class="grid">
                <label class="mb-1" for="penerbit">Penerbit</label>
                <input type="text" name="penerbit" id="penerbit" class="w-full p-2 rounded border bg-gray-100 border-gray-300 text-sm" value="{{ old('penerbit') }}" placeholder="Masukan Penebit" autocomplete="off" required>
            </div>
            <div class="grid">
                <label class="mb-1" for="tahun_terbit">Tahun Terbit</label>
                <input type="number" name="tahun_terbit" id="tahun_terbit" min="1800" max="2100" class="w-full p-2 rounded border bg-gray-100 border-gray-300 text-sm" value="{{ old('tahun_terbit') }}" placeholder="YYYY" required>
            </div>
            <div class="grid">
                <label class="mb-1" for="kode">Kode</label>
                <input type="text" name="kode" id="kode" class="w-full p-2 rounded border bg-gray-100 border-gray-300 text-sm" value="{{ old('kode') }}" placeholder="Masukan kode" autocomplete="off" required>
            </div>
            <div class="grid">
                <label class="mb-1" for="stok">Stok</label>
                <input type="number" name="stok" id="stok" class="w-full p-2 rounded border bg-gray-100 border-gray-300 text-sm" value="{{ old('stok') }}" placeholder="Masukan stok" autocomplete="off" required>
            </div>
            <div class="grid text-sm">
                <label class="mb-1" for="cover">Cover Buku</label>
                <input type="file" name="cover" id="cover" class="w-full rounded border bg-gray-100 border-gray-300 text-sm cursor-pointer file:cursor-pointer file:mr-2 file:py-2 file:text-sm file:rounded-l file:bg-blue-900 file:text-white file:border-none">
            </div>
            <div class="grid text-sm">
                <label class="mb-1" for="deskripsi">Deskripsi Buku</label>
                <textarea name="deskripsi" id="deskripsi" class="border-gray-300 border bg-gray-100 rounded p-2" value="{{ old('deskripsi') }}" required oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px';" required></textarea>
            </div>
            <div class="flex justify-end">
                <button class="bg-blue-900 py-2 px-3 text-sm rounded text-white">Tambah</button>
            </div>
        </div>
    </form>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var textarea = document.getElementById("deskripsi");
            textarea.style.height = textarea.scrollHeight + "px";
        });
    </script>
    
@endsection