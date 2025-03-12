@extends('peminjam.layout.layout')
@section('content')
    <div class="flex flex-col lg:flex-row gap-8 items-start">
        <div class="w-full lg:w-1/5 flex justify-center">
            @if (Str::startsWith($peminjaman->buku->cover, 'http'))
                <img src="{{ $peminjaman->buku->cover }}" class="w-40 lg:w-auto object-cover rounded" alt="{{ $peminjaman->buku->judul }}">
            @else
                <img src="{{ asset('storage/' . $peminjaman->buku->cover) }}" class="w-40 lg:w-auto object-cover rounded" alt="{{ $peminjaman->buku->judul }}">
            @endif
        </div>

        <div class="w-full lg:w-4/5">
            <div class="bg-white p-4 rounded gap-4 flex flex-col shadow">
                <div class="grid gap-4 text-sm lg:text-base">
                    <div class="flex justify-between border-b pb-2">
                        <span class="font-semibold text-gray-700">Buku:</span>
                        <span class="text-gray-900 text-right">{{ $peminjaman->buku->judul }}</span>
                    </div>
                    <div class="flex justify-between border-b pb-2">
                        <span class="font-semibold text-gray-700">Nama Peminjam:</span>
                        <span class="text-gray-900 text-right">{{ $peminjaman->peminjam->nama }}</span>
                    </div>
                    <div class="flex justify-between border-b pb-2">
                        <span class="font-semibold text-gray-700">Tanggal Pinjam:</span>
                        <span class="text-gray-900 text-right">{{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->translatedFormat('j F Y') }}</span>
                    </div>
                    <div class="flex justify-between border-b pb-2">
                        <span class="font-semibold text-gray-700">Tanggal Kembali:</span>
                        <span class="text-gray-900 text-right">{{ \Carbon\Carbon::parse($peminjaman->tanggal_kembali)->translatedFormat('j F Y') }}</span>
                    </div>
                    <div class="flex justify-between border-b pb-2">
                        <span class="font-semibold text-gray-700">Jumlah:</span>
                        <span class="text-gray-900 text-right">{{ $peminjaman->jumlah }}</span>
                    </div>
                    @if ($peminjaman->petugas !== null) 
                        <div class="flex justify-between border-b pb-2">
                            <span class="font-semibold text-gray-700">Petugas:</span>
                            <span class="text-gray-900 text-right">{{ $peminjaman->petugas->nama }}</span>
                        </div>
                    @endif
                    <div class="flex justify-between">
                        <span class="font-semibold text-gray-700">Status:</span>
                        <span class="text-gray-900 text-right capitalize">{{ $peminjaman->status }}</span>
                    </div>
                </div>
            </div>
            <div class="justify-start flex mt-6">
                <a href="{{ route('peminjam.peminjamanBuku') }}" class="text-sm lg:text-base bg-blue-900 hover:bg-blue-950 text-white flex items-center gap-2 py-2 px-4 rounded-full">
                    <i class="fa-solid fa-arrow-left text-sm"></i>
                    <span>Kembali</span>
                </a>
            </div>
        </div>
    </div>
@endsection