@extends('peminjam.layout.layout')
@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        @foreach ($peminjaman as $item) 
            <div class="bg-white p-4 rounded shadow">
                <div class="flex gap-2">
                    <div class="w-1/6">
                        @if (Str::startsWith($item->buku->cover, 'http'))
                            <img src="{{ $item->buku->cover }}" class="w-full h-full bg-cover rounded transition-all ease-in-out" alt="{{ $item->buku->judul }}">
                        @else
                            <img src="{{ asset('storage/'. $item->buku->cover) }}" class="w-full h-full bg-cover rounded transition-all ease-in-out" alt="{{ $item->buku->judul }}"> 
                        @endif
                    </div>
                    <div class="flex flex-col w-5/6 justify-between">
                        <div class="grid">
                            <span class="font-bold">{{ $item->buku->judul }}</span>
                        </div>
                        <div class="grid">
                            <div class="flex text-sm items-center gap-2">
                                <span>Tanggal pinjam:</span>
                                <span class="text-neutral-500">{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->translatedFormat('j F Y') }}</span>
                            </div>
                            <div class="flex text-sm items-center gap-2">
                                <span>Tanggal kembali:</span>
                                <span class="text-neutral-500">{{ \Carbon\Carbon::parse($item->tanggal_kembali)->translatedFormat('j F Y') }}</span>
                            </div>
                            <div class="flex text-sm items-center gap-2">
                                <span>Jumlah:</span>
                                <span class="text-neutral-500">{{ $item->jumlah }}</span>
                            </div>
                        </div>
                        <div class="">
                            <span class="capitalize bg-green-400 py-2 px-4 rounded-full text-sm">{{ $item->status }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection