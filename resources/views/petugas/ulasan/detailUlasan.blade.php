@extends('petugas.layout.layout')
@section('content')
<div class="grid gap-10">
    <div class="flex flex-col lg:flex-row gap-8 items-start">
        <div class="w-full lg:w-1/3 flex justify-center">
            <img src="{{ asset('storage/'. ($buku->cover)) }}" alt="Cover Buku" class="lg:w-[70%] w-[50%] rounded bg-cover">
        </div>

        <div class="w-full lg:w-3/4 flex flex-col gap-4 text-sm lg:text-base">
            <div class="pt-4">
                @foreach ($ulasan as $item)
                    <div class="p-4 bg-gray-100 rounded flex items-start justify-between shadow-sm mb-3">
                        <div class="grid">
                            <span class="font-semibold text-blue-900">{{ $item->peminjam->nama }}</span>
                            <p class="text-gray-700 text-sm mt-1">{{ $item->ulasan }}</p>
                        </div>
                        <div class="">
                            <span class="text-xs text-gray-500">{{ $item->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
