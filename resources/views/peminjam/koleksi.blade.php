@extends('peminjam.layout.layout')
@section('content')
    @if ($koleksi->isEmpty()) 
        <div class="flex flex-col items-center justify-center h-64">
            <i class="fa-solid fa-box-open text-6xl text-neutral-400"></i>    
            <span class="text-neutral-400 mt-4">Tidak ada koleksi</span>    
        </div> 
    @else
        <div class="grid w-full lg:flex gap-2">
            @foreach ($koleksi as $item) 
                <a href="{{ route('peminjam.detailBuku', $item->slug) }}" class="bg-white p-4 shadow rounded w-80">
                    <div class="grid gap-4">
                        <div class="w-full rounded flex justify-center">
                            @if (Str::startsWith($item->cover, 'http'))
                                <img src="{{ $item->cover }}" class="object-cover w-40 rounded" alt="{{ $item->judul }}">
                            @else
                                <img src="{{ asset('storage/'. $item->cover) }}" class="object-cover w-40 rounded" alt="{{ $item->judul }}"> 
                            @endif
                        </div>
                        <div class="grid gap-2">
                            <div class="truncate">
                                <h3 class="font-bold text-left truncate">{{ $item->judul }}</h3>
                            </div>
                            <div class="text-sm text-neutral-500 text-left">
                                <div>
                                    <span class="font-bold">Kategori: </span>
                                    <span>{{ $item->kategori }}</span>
                                </div>
                                <div>
                                    <span class="font-bold">Stok: </span>
                                    <span>{{ $item->stok }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @endif
@endsection