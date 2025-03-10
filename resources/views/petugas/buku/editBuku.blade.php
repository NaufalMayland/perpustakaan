@extends('petugas.layout.layout')
@section('content')
    <div class="bg-white p-4 shadow-md rounded">
        <form action="{{ route('petugas.buku.editBukuAction', $buku->id) }}" method="POST" class="flex flex-col lg:flex-row gap-8 items-start" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="w-full lg:w-1/4 flex justify-center">
                @if (Str::startsWith($buku->cover, 'http'))
                    <img src="{{ $buku->cover }}" class="w-auto object-cover rounded" alt="{{ $buku->judul }}">
                @else
                    <img src="{{ asset('storage/' . $buku->cover) }}" class="w-auto object-cover rounded" alt="{{ $buku->judul }}"> 
                @endif
            </div>
            <div class="w-full lg:w-3/4 flex flex-col gap-4 text-sm lg:text-base">
                <div class="grid">
                    <label for="judul">Judul Buku</label>
                    <input type="text" name="judul" id="judul" class="w-full p-2 rounded border bg-gray-100 border-gray-300 text-sm" value="{{ $buku->judul }}" placeholder="Masukan judul buku" autocomplete="off" required>
                </div>
                <div class="grid">
                    <label for="penulis">Penulis</label>
                    <input type="text" name="penulis" id="penulis" class="w-full p-2 rounded border bg-gray-100 border-gray-300 text-sm" value="{{ $buku->penulis }}" placeholder="Masukan penulis" autocomplete="off" required>
                </div>
                <div class="grid">
                    <label for="penerbit">Penerbit</label>
                    <input type="text" name="penerbit" id="penerbit" class="w-full p-2 rounded border bg-gray-100 border-gray-300 text-sm" value="{{ $buku->penerbit }}" placeholder="Masukan Penebit" autocomplete="off" required>
                </div>
                <div class="grid">
                    <label for="tahun_terbit">Tahun Terbit</label>
                    <input type="number" name="tahun_terbit" id="tahun_terbit" min="1800" max="2100" class="w-full p-2 rounded border bg-gray-100 border-gray-300 text-sm" value="{{ $buku->tahun_terbit }}" placeholder="YYYY" required>
                </div>
                <div class="grid">
                    <label for="kode">Kode</label>
                    <input type="text" name="kode" id="kode" class="w-full p-2 rounded border bg-gray-100 border-gray-300 text-sm" value="{{ $buku->kode }}" placeholder="Masukan kode" autocomplete="off" required>
                </div>
                <div class="grid">
                    <label for="stok">Stok</label>
                    <input type="number" name="stok" id="stok" class="w-full p-2 rounded border bg-gray-100 border-gray-300 text-sm" value="{{ $buku->stok }}" placeholder="Masukan stok" autocomplete="off" required>
                </div>
                <div class="grid text-sm">
                    <div class="flex items-center gap-2 text-sm">
                        <label class="mb-1">Cover Buku</label>
                        <div class="flex gap-4">
                            <label class="flex items-center gap-1">
                                <input type="radio" name="cover_type" value="file" onclick="toggleCoverInput()"  @if(!Str::startsWith($buku->cover, 'http')) checked @endif> 
                                <span>File</span>
                                @if (!Str::startsWith($buku->cover, 'http'))
                                    <input type="hidden" name="cover_url" value="{{ $buku->cover }}">
                                @endif
                            </label>
                            <label class="flex items-center gap-1">
                                <input type="radio" name="cover_type" value="url" onclick="toggleCoverInput()" @if(Str::startsWith($buku->cover, 'http')) checked @endif> 
                                <span>URL</span>
                            </label>
                        </div>
                    </div>
                    <div id="cover_file_input" class="{{ Str::startsWith($buku->cover, 'http') ? 'hidden' : '' }}">
                        <input type="file" name="cover_file" id="cover_file" class="w-full rounded border bg-gray-100 border-gray-300 text-sm cursor-pointer file:cursor-pointer file:mr-2 file:py-2 file:text-sm file:rounded-l file:bg-blue-900 file:text-white file:border-none">
                    </div>
                    <div id="cover_url_input" class="{{ !Str::startsWith($buku->cover, 'http') ? 'hidden' : '' }}">
                        <input type="text" name="cover_url" id="cover_url" class="w-full p-2 rounded border bg-gray-100 border-gray-300 text-sm" placeholder="Masukkan URL" value="{{ Str::startsWith($buku->cover, 'http') ? $buku->cover : '' }}" autocomplete="off">
                    </div>
                </div>
                <div class="grid text-sm">
                    <label for="deskripsi">Deskripsi Buku</label>
                    <textarea name="deskripsi" id="deskripsi" class="border-gray-300 border bg-gray-100 rounded p-2" required oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px';" required>{{ $buku->deskripsi }}</textarea>
                </div>
                <div class="justify-between flex w-full items-center mt-2">
                    <div class="flex">
                        <a href="{{ route('petugas.buku.detailBuku', $buku->slug) }}" class="bg-blue-900 hover:bg-blue-950 text-white flex w-full items-center gap-2 py-2 px-3 rounded-full text-sm">
                            <i class="fa-solid fa-arrow-left text-sm"></i>
                            <span>Kembali</span>
                        </a>
                    </div>      
                    <div class="flex">
                        <button type="submit" class="bg-blue-900 hover:bg-blue-950 text-white flex w-full items-center gap-2 py-2 px-3 rounded-full text-sm">Simpan</button>
                    </div>      
                </div>
            </div>
        </form>
    </div>
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
            var textarea = document.getElementById("deskripsi");
            textarea.style.height = textarea.scrollHeight + "px";
        });
    </script>
@endsection
