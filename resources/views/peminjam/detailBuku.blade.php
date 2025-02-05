@extends('peminjam.layout.layout')
@section('content')
    <div class="flex flex-col lg:flex-row gap-8 items-start">
        <!-- Gambar Buku -->
        <div class="w-full lg:w-1/3 flex justify-center">
            <img src="{{ asset('storage/'. ($buku->buku->cover)) }}" alt="Cover Buku" class="w-[70%] rounded bg-cover">
        </div>

        <!-- Informasi Buku -->
        <div class="w-full lg:w-3/4 flex flex-col gap-4 text-sm lg:text-base">
            <div class="text-center lg:text-left">
                <span class="text-xl font-bold">{{ $buku->buku->judul}}</span>
            </div>

            <div>
                <p class="text-justify">{{ $buku->buku->deskripsi}}</p>
            </div>

            <div class="flex flex-col gap-2">
                <div>
                    <span class="font-semibold">Penulis:</span>
                    <span>{{ $buku->buku->penulis}}</span>
                </div>
                <div>
                    <span class="font-semibold">Tahun Terbit:</span>
                    <span>{{ $buku->buku->tahun_terbit}}</span>
                </div>
                <div>
                    <span class="font-semibold">Kategori:</span>
                    <span class="capitalize">{{ $buku->kategori->kategori}}</span>
                </div>
            </div>
            
            <!-- Tombol Aksi -->
            <div class="flex flex-row mt-2 gap-4 items-center w-full justify-start text-sm lg:text-base">
                <a href="#" class="bg-blue-900 hover:bg-blue-950 text-white py-2 px-20 rounded-full">Pinjam</a>
                <a href="#" class="rounded-full py-2 px-4 border border-gray-300 flex items-center justify-center">
                    <i class="fa-solid fa-plus text-sm"></i>
                </a>
            </div>
        </div>
    </div>
@endsection
