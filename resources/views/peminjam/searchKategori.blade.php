@extends('peminjam.layout.layout')
@section('content')
    <div class="grid gap-10">
        <div class="flex flex-col gap-4">
            <div class="flex justify-between">
                <span class="capitalize flex text-left">Kategori {{ $header->kategori }}</span>
            </div>
            <div class="w-full grid grid-cols-8 gap-4">
                @foreach ($buku as $item)
                    <a href="{{ route('peminjam.detailBuku', $item->id) }}" class="flex flex-col">
                        @if (Str::startsWith($item->cover, 'http'))
                            <img src="{{ $item->cover }}" class="w-full h-full bg-cover rounded transition-all ease-in-out" alt="{{ $item->judul }}">
                        @else
                            <img src="{{ asset('storage/' . $item->cover) }}" class="w-full h-full bg-cover rounded transition-all ease-in-out" alt="{{ $item->judul }}"> 
                        @endif
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection