@extends('petugas.layout.layout')
@section('content')
<div class="grid gap-10 bg-white p-4 rounded shadow">
    <div class="flex flex-col lg:flex-row gap-8 items-start">
        <div class="w-full lg:w-1/5 flex justify-center">
            @if (Str::startsWith($buku->cover, 'http'))
                <img src="{{ asset($buku->cover) }}" alt="Cover Buku" class="w-auto rounded bg-cover">
            @else
                <img src="{{ asset('storage/'. ($buku->cover)) }}" alt="Cover Buku" class="w-auto rounded bg-cover">
            @endif
        </div>

        <div class="w-full lg:w-4/5 flex flex-col gap-4 text-sm lg:text-base">
            <div class="grid gap-4">
                <div class="grid justify-center text-center">
                    <span class="text-lg font-bold">{{ $buku->judul }}</span>
                    <span class="text-sm text-neutral-500">{{ $buku->penulis }}</span>
                </div>
                <div class="">
                    <span class="text-center text-sm">{{ $buku->deskripsi }}</span>
                </div>
            </div>
            @if ($check == false)
                <div class="">
                    <span class="text-sm font-bold">Belum ada ulasan</span>
                </div>
            @else
                <div class="">
                    <span class="text-sm font-bold">Ulasan:</span>
                </div>
            @endif
            @foreach ($ulasan as $item) 
                <div class="p-4 bg-gray-100 rounded flex flex-col items-start shadow-sm border border-gray-300">
                    <div class="flex justify-between w-full items-center">
                        <div class="flex w-full gap-1 items-center">
                            <span class="font-semibold text-blue-900">{{ $item->peminjam->nama }}</span>
                            <span class="text-xs text-gray-500">-</span>
                            <span class="text-xs text-gray-500">{{ $item->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                    <div class="">
                        <p class="text-gray-700 text-sm mt-1">{{ $item->ulasan }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
