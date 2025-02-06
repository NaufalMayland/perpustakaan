@extends('petugas.layout.layout')
@section('content')
    <div class="bg-white p-4 shadow-md rounded">
        <div class="flex flex-col lg:flex-row gap-8 items-start">
            <div class="w-full lg:w-1/4 flex justify-center">
                <img src="{{ asset('storage/'. ($buku->cover)) }}" alt="Cover Buku" class="w-full rounded bg-cover">
            </div>

            <div class="w-full lg:w-3/4 flex flex-col gap-4 text-sm lg:text-base">
                <div class="text-center lg:text-left">
                    <span class="text-lg font-bold">{{ $buku->judul}}</span>
                </div>

                <div>
                    <p class="text-justify text-sm">{{ $buku->deskripsi}}</p>
                </div>

                <div class="flex flex-col gap-2 text-sm">
                    <div>
                        <span class="font-semibold">Penulis:</span>
                        <span>{{ $buku->penulis}}</span>
                    </div>
                    <div>
                        <span class="font-semibold">Penerbit:</span>
                        <span>{{ $buku->penerbit}}</span>
                    </div>
                    <div>
                        <span class="font-semibold">Tahun Terbit:</span>
                        <span>{{ $buku->tahun_terbit}}</span>
                    </div>
                    <div>
                        <span class="font-semibold">Kode:</span>
                        <span>{{ $buku->kode}}</span>
                    </div>
                    <div>
                        <span class="font-semibold">Stok:</span>
                        <span>{{ $buku->stok}}</span>
                    </div>
                </div>
                
                <div class="justify-between flex w-full items-center">
                    <div class="flex flex-row mt-2 gap-4 items-center text-sm">
                        <a href="{{ route('petugas.buku.index') }}" class="bg-blue-900 hover:bg-blue-950 text-white flex w-full items-center gap-2 py-2 px-4 rounded">
                            <i class="fa-solid fa-arrow-left text-sm"></i>
                            <span>Exit</span>
                        </a>
                    </div>
                    <div class="flex flex-row mt-2 gap-4 items-center text-sm">
                        <a href="{{ route('petugas.buku.editBuku', $buku->id) }}" class="bg-blue-900 hover:bg-blue-950 text-white flex w-full items-center gap-2 py-2 px-4 rounded">
                            <i class="fa-solid fa-pencil text-sm"></i>
                            <span>Edit</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
