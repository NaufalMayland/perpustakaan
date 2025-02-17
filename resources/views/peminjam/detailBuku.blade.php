@extends('peminjam.layout.layout')
@section('content')
<div class="grid gap-10">
    <div class="flex flex-col lg:flex-row gap-8 items-start">
        <div class="w-full lg:w-1/3 flex justify-center">
            <img src="{{ asset('storage/'. ($buku->buku->cover)) }}" alt="Cover Buku" class="lg:w-[70%] w-[50%] rounded bg-cover">
        </div>

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
                    <span class="capitalize">{{ $getKategori }}</span>
                </div>
            </div>
            
            <div class="justify-between flex w-full">
                <div class="flex flex-row mt-2 gap-4 items-center text-sm">
                    <a href="" class="bg-blue-900 hover:bg-blue-950 text-white flex w-full items-center gap-2 py-2 px-4 rounded-full">
                        <i class="fa-solid fa-arrow-left text-sm"></i>
                        <span>Kembali</span>
                    </a>
                </div>
                <div class="flex flex-row mt-2 gap-4 items-center lg:text-base">
                    <a href="#" class="bg-blue-900 hover:bg-blue-950 text-white py-2 px-20 rounded-full">Pinjam</a>
                    <a href="#" class="rounded-full py-2 px-4 border border-gray-300 flex items-center justify-center">
                        <i class="fa-solid fa-plus text-sm"></i>
                    </a>
                </div>
            </div>

        </div>
    </div>
    <div class="gap-6 grid">
        <div class="text-2xl font-bold border-b pb-2">Ulasan</div>
        
        <form action="{{ route('peminjam.addUlasanAction', $buku->buku->id) }}" method="POST" class="flex gap-3">
            @csrf
            <input type="text" name="ulasan" class="w-full p-2 rounded border bg-gray-100 border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Berikan ulasanmu">
            <button type="submit" class="bg-blue-900 hover:bg-blue-950 rounded-full py-2 px-5 text-white font-medium">Kirim</button>
        </form>
        
        <div class="border-t pt-4">
            @foreach ($ulasan as $item)
                <div class="p-4 bg-gray-100 rounded shadow-sm mb-3">
                    <span class="font-semibold text-blue-900">{{ $item->peminjam->nama }}</span>
                    <p class="text-gray-700 text-sm mt-1">{{ $item->ulasan }}</p>
                </div>
            @endforeach
        </div>
    </div>
    
</div>
@endsection
