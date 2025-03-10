@extends('peminjam.layout.layout')
@section('content')
    <div class="grid gap-8">
        @if ($buku->isNotEmpty()) 
            <div class="flex flex-col gap-2">
                <div class="flex justify-between">
                    <span class="capitalize flex text-left">Banyak dipinjam</span>
                </div>
                <div class="w-full grid grid-cols-8 gap-4">
                    @foreach ($buku as $item) 
                        <a href="{{ route('peminjam.detailBuku', $item->slug) }}" class="flex flex-col">
                            @if (Str::startsWith($item->cover, 'http'))
                                <img src="{{ $item->cover }}" class="w-full h-full bg-cover rounded transition-all ease-in-out" alt="{{ $item->judul }}">
                            @else
                                <img src="{{ asset('storage/' . $item->cover) }}" class="w-full h-full bg-cover rounded transition-all ease-in-out" alt="{{ $item->judul }}"> 
                            @endif
                        </a>
                    @endforeach
                </div> 
            </div>
        @endif
        @foreach ($bukuKategori as $kategori => $dataBuku)
            <div class="flex flex-col gap-2">
                <div class="flex justify-between">
                    <span class="capitalize flex text-left">{{ $dataBuku->first()->kategori }}</span>
                </div>
                <div class="w-full grid grid-cols-8 gap-4">
                    @foreach ($dataBuku as $item) 
                        <a href="{{ route('peminjam.detailBuku', $item->slug) }}" class="flex flex-col">
                            @if (Str::startsWith($item->cover, 'http'))
                                <img src="{{ $item->cover }}" class="w-full h-full bg-cover rounded transition-all ease-in-out" alt="{{ $item->judul }}">
                            @else
                                <img src="{{ asset('storage/' . $item->cover) }}" class="w-full h-full bg-cover rounded transition-all ease-in-out" alt="{{ $item->judul }}"> 
                            @endif
                        </a>
                    @endforeach
                </div> 
            </div>
        @endforeach
    </div>
@endsection