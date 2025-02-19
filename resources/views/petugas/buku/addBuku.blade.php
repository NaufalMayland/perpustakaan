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
                <input type="text" name="penerbit" id="penerbit" class="w-full p-2 rounded border bg-gray-100 border-gray-300 text-sm" value="{{ old('penerbit') }}" placeholder="Masukan Penerbit" autocomplete="off" required>
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
            
            <div class="grid">
                <div class="flex items-center gap-2 text-sm">
                    <label class="mb-1">Cover Buku</label>
                    <div class="flex gap-4">
                        <label>
                            <input type="radio" name="cover_type" value="file" checked onclick="toggleCoverInput()"> File
                        </label>
                        <label>
                            <input type="radio" name="cover_type" value="url" onclick="toggleCoverInput()"> URL
                        </label>
                    </div>
                </div>
    
                <div class="text-sm" id="cover_file_input">
                    <input type="file" name="cover_file" id="cover_file" class="w-full rounded border bg-gray-100 border-gray-300 text-sm cursor-pointer file:cursor-pointer file:mr-2 file:py-2 file:text-sm file:rounded-l file:bg-blue-900 file:text-white file:border-none">
                </div>
                
                <div class="text-sm hidden" id="cover_url_input">
                    <input type="text" name="cover_url" id="cover_url" class="w-full p-2 rounded border bg-gray-100 border-gray-300 text-sm" placeholder="Masukkan URL ">
                </div>
            </div>

            <div class="grid text-sm">
                <label class="mb-1" for="deskripsi">Deskripsi Buku</label>
                <textarea name="deskripsi" id="deskripsi" class="border-gray-300 border bg-gray-100 rounded p-2" required oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px';"></textarea>
            </div>
            <div class="flex justify-end">
                <button class="bg-blue-900 py-2 px-3 text-sm rounded text-white">Tambah</button>
            </div>
        </div>
    </form>

    <script>
        function toggleCoverInput() {
            let fileInput = document.getElementById('cover_file_input');
            let urlInput = document.getElementById('cover_url_input');
            let fileRadio = document.querySelector('input[name="cover_type"][value="file"]').checked;

            if (fileRadio) {
                fileInput.classList.remove('hidden');
                urlInput.classList.add('hidden');
            } else {
                fileInput.classList.add('hidden');
                urlInput.classList.remove('hidden');
            }
        }
        
        document.addEventListener("DOMContentLoaded", function () {
            toggleCoverInput();
            var textarea = document.getElementById("deskripsi");
            textarea.style.height = textarea.scrollHeight + "px";
        });
    </script>
@endsection
