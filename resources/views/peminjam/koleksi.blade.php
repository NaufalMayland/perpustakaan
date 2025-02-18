@extends('peminjam.layout.layout')
@section('content')
    <div class="grid gap-4">
        @foreach ($koleksi as $item) 
            <div class="bg-white p-4 rounded">
                {{-- <div class="">
                    <input type="checkbox" name="" id="">
                </div> --}}
                <div class="flex gap-2">
                    <div class="w-1/6">
                        <img src="{{ asset('storage/'. $item->cover) }}" alt="" class="w-40 rounded">
                    </div>
                    <div class="flex flex-col w-5/6">
                        <div class="">
                            <span class="font-bold">{{ $item->judul }}</span>
                        </div>
                        <div class="">
                            <span class="text-gray-500 capitalize">{{ $item->kategori }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection