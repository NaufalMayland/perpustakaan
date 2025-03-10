@extends('peminjam.layout.layout')
@section('content')
    @if ($koleksi->isEmpty())
        <div class="w-full items-center justify-center flex flex-col">
            <div class="">
                <i class="fa-solid fa-box-open text-6xl text-neutral-400"></i>    
            </div>  
            <div class="">
                <span class="text-neutral-400">Tidak ada koleksi</span>    
            </div>  
        </div>
    @else 
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            @foreach ($koleksi as $item) 
                <div class="bg-white p-4 rounded shadow">
                    <div class="flex gap-2">
                        <div class="w-1/6">
                            <a href="{{ route('peminjam.detailBuku', $item->slug) }}" class="p-2 flex items-center">
                                @if (Str::startsWith($item->cover, 'http'))
                                    <img src="{{ $item->cover }}" class="w-full h-full bg-cover rounded transition-all ease-in-out" alt="{{ $item->judul }}">
                                @else
                                    <img src="{{ asset('storage/'. $item->cover) }}" class="w-full h-full bg-cover rounded transition-all ease-in-out" alt="{{ $item->buku->judul }}"> 
                                @endif
                            </a>
                        </div>
                        <div class="flex flex-col w-5/6">
                            <div class="grid">
                                <span class="font-bold">{{ $item->judul }}</span>
                            </div>
                            <div class="grid">
                                <div class="flex text-sm items-center gap-2">
                                    <span>Kategori:</span>
                                    <span class="text-neutral-500">{{ $item->kategori }}</span>
                                </div>
                                <div class="flex text-sm items-center gap-2">
                                    <span>Stok:</span>
                                    <span class="text-neutral-500">{{ $item->stok }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection