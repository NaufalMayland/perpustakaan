@extends('peminjam.layout.layout')
@section('content')
    <div class="flex flex-col lg:flex-row gap-8 items-start">
        <div class="w-full lg:w-1/5 flex justify-center">
            @if (Str::startsWith($riwayat->buku->cover, 'http'))
                <img src="{{ $riwayat->buku->cover }}" class="w-40 lg:w-auto object-cover rounded" alt="{{ $riwayat->buku->judul }}">
            @else
                <img src="{{ asset('storage/' . $riwayat->buku->cover) }}" class="w-40 lg:w-auto object-cover rounded" alt="{{ $riwayat->buku->judul }}">
            @endif
        </div>

        <div class="w-full lg:w-4/5">
            <div class="bg-white p-4 rounded gap-4 flex flex-col shadow">
                <div class="grid gap-4 text-sm lg:text-base">
                    <div class="flex justify-between border-b pb-2">
                        <span class="w-full font-semibold text-gray-700">Buku:</span>
                        <span class="w-full text-gray-900 text-right">{{ $riwayat->buku->judul }}</span>
                    </div>
                    <div class="flex justify-between border-b pb-2">
                        <span class="w-full font-semibold text-gray-700">Nama Peminjam:</span>
                        <span class="w-full text-gray-900 text-right">{{ $riwayat->peminjam->nama }}</span>
                    </div>
                    <div class="flex justify-between border-b pb-2">
                        <span class="w-full font-semibold text-gray-700">Tanggal Pinjam:</span>
                        <span class="w-full text-gray-900 text-right">{{ \Carbon\Carbon::parse($riwayat->tanggal_pinjam)->translatedFormat('j F Y') }}</span>
                    </div>
                    <div class="flex justify-between border-b pb-2">
                        <span class="w-full font-semibold text-gray-700">Tanggal Kembali:</span>
                        <span class="w-full text-gray-900 text-right">{{ \Carbon\Carbon::parse($riwayat->tanggal_kembali)->translatedFormat('j F Y') }}</span>
                    </div>
                    <div class="flex justify-between border-b pb-2">
                        <span class="w-full font-semibold text-gray-700">Tanggal Dikembalikan:</span>
                        <span class="w-full text-gray-900 text-right">{{ \Carbon\Carbon::parse($riwayat->tanggal_dikembalikan)->translatedFormat('j F Y') }}</span>
                    </div>
                    <div class="flex justify-between border-b pb-2">
                        <span class="w-full font-semibold text-gray-700">Jumlah:</span>
                        <span class="w-full text-gray-900 text-right">{{ $riwayat->jumlah }}</span>
                    </div>
                    <div class="flex justify-between border-b pb-2">
                        <span class="w-full font-semibold text-gray-700">Petugas:</span>
                        <span class="w-full text-gray-900 text-right">{{ $riwayat->petugas->nama }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="w-full font-semibold text-gray-700">Denda:</span>
                        @if ($denda !== null) 
                            <span class="w-full text-gray-900 text-right capitalize">{{ $denda->status }}</span>
                        @else    
                        <span class="w-full text-gray-900 text-right capitalize">-</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="justify-start flex mt-6">
                <a href="{{ route('peminjam.riwayat') }}" class="text-sm lg:text-base bg-blue-900 hover:bg-blue-950 text-white flex items-center gap-2 py-2 px-4 rounded-full">
                    <i class="fa-solid fa-arrow-left text-sm"></i>
                    <span>Kembali</span>
                </a>
            </div>
        </div>
    </div>
@endsection