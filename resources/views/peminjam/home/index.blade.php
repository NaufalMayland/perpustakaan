@extends('peminjam.layout.layout')
@section('content')
    <div class="px-4">
        <div class="flex flex-col mt-4 gap-4">
            <div class="flex justify-between">
                <span class="capitalize flex text-left">Buku Teratas</span>
                <a href="#" class="capitalize flex text-left">Selengkapnya ></a>
            </div>
            <div class="flex gap-4">
                @foreach ($buku as $item)
                    <a href="#" class="flex flex-col">
                        <img class="w-32 rounded transition-all ease-in-out" src="{{ asset('storage/' . $item->buku->cover) }}" alt="">
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection