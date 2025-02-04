@extends('peminjam.layout.layout')
@section('content')
    <div class="flex flex-row gap-4">
        <div class="">
            <img src="{{ asset('storage/'. $buku->buku->cover) }}" alt="" class="w-60">
        </div>
        <div class="">
            <div class="">
                <span class="text-lg">{{ $buku->buku->judul }}</span>
            </div>
        </div>
    </div>
@endsection