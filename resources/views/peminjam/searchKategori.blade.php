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
                        <img class="w-full h-full bg-cover rounded transition-all ease-in-out" src="{{ asset('storage/'. $item->cover) }}" alt="">                  
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection