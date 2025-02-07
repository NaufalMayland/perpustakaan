@extends('peminjam.layout.layout')
@section('content')
    <div class="grid gap-10">
        <div class="flex flex-col gap-4">
            <div class="flex justify-between">
                <span class="capitalize flex text-left">Buku Teratas</span>
                <a href="#" class="capitalize flex text-left">Selengkapnya ></a>
            </div>
            <div class="w-full grid grid-cols-8 gap-4">
                @foreach ($buku as $item) 
                    <a href="{{ route('peminjam.detailBuku', $item->id) }}" class="flex flex-col">
                        <img class="w-full h-full bg-cover rounded transition-all ease-in-out" src="{{ asset('storage/'. $item->buku->cover) }}" alt="">                  
                    </a>
                @endforeach
            </div>
        </div>
        {{-- <div class="flex flex-col mt-4 gap-4">
            <div class="flex justify-between">
                <span class="capitalize flex text-left">Buku Teratas</span>
                <a href="#" class="capitalize flex text-left">Selengkapnya ></a>
            </div>
            <div class="grid grid-cols-8 gap-4">
                <a href="#" class="flex flex-col">
                    <img class="w-32 rounded transition-all ease-in-out" src="{{ asset('storage/cover/contoh.jpg') }}" alt="">
                </a>
                <a href="#" class="flex flex-col">
                    <img class="w-32 rounded transition-all ease-in-out" src="{{ asset('storage/cover/contoh.jpg') }}" alt="">
                </a>
                <a href="#" class="flex flex-col">
                    <img class="w-32 rounded transition-all ease-in-out" src="{{ asset('storage/cover/contoh.jpg') }}" alt="">
                </a>
                <a href="#" class="flex flex-col">
                    <img class="w-32 rounded transition-all ease-in-out" src="{{ asset('storage/cover/contoh.jpg') }}" alt="">
                </a>
                <a href="#" class="flex flex-col">
                    <img class="w-32 rounded transition-all ease-in-out" src="{{ asset('storage/cover/contoh.jpg') }}" alt="">
                </a>
                <a href="#" class="flex flex-col">
                    <img class="w-32 rounded transition-all ease-in-out" src="{{ asset('storage/cover/contoh.jpg') }}" alt="">
                </a>
                <a href="#" class="flex flex-col">
                    <img class="w-32 rounded transition-all ease-in-out" src="{{ asset('storage/cover/contoh.jpg') }}" alt="">
                </a>
                <a href="#" class="flex flex-col">
                    <img class="w-32 rounded transition-all ease-in-out" src="{{ asset('storage/cover/contoh.jpg') }}" alt="">
                </a>
            </div>
        </div>
        <div class="flex flex-col mt-4 gap-4">
            <div class="flex justify-between">
                <span class="capitalize flex text-left">Buku Teratas</span>
                <a href="#" class="capitalize flex text-left">Selengkapnya ></a>
            </div>
            <div class="grid grid-cols-8 gap-4">
                <a href="#" class="flex flex-col">
                    <img class="w-32 rounded transition-all ease-in-out" src="{{ asset('storage/cover/contoh.jpg') }}" alt="">
                </a>
                <a href="#" class="flex flex-col">
                    <img class="w-32 rounded transition-all ease-in-out" src="{{ asset('storage/cover/contoh.jpg') }}" alt="">
                </a>
                <a href="#" class="flex flex-col">
                    <img class="w-32 rounded transition-all ease-in-out" src="{{ asset('storage/cover/contoh.jpg') }}" alt="">
                </a>
                <a href="#" class="flex flex-col">
                    <img class="w-32 rounded transition-all ease-in-out" src="{{ asset('storage/cover/contoh.jpg') }}" alt="">
                </a>
                <a href="#" class="flex flex-col">
                    <img class="w-32 rounded transition-all ease-in-out" src="{{ asset('storage/cover/contoh.jpg') }}" alt="">
                </a>
                <a href="#" class="flex flex-col">
                    <img class="w-32 rounded transition-all ease-in-out" src="{{ asset('storage/cover/contoh.jpg') }}" alt="">
                </a>
                <a href="#" class="flex flex-col">
                    <img class="w-32 rounded transition-all ease-in-out" src="{{ asset('storage/cover/contoh.jpg') }}" alt="">
                </a>
                <a href="#" class="flex flex-col">
                    <img class="w-32 rounded transition-all ease-in-out" src="{{ asset('storage/cover/contoh.jpg') }}" alt="">
                </a>
            </div>
        </div>
        <div class="flex flex-col mt-4 gap-4">
            <div class="flex justify-between">
                <span class="capitalize flex text-left">Buku Teratas</span>
                <a href="#" class="capitalize flex text-left">Selengkapnya ></a>
            </div>
            <div class="grid grid-cols-8 gap-4">
                <a href="#" class="flex flex-col">
                    <img class="w-32 rounded transition-all ease-in-out" src="{{ asset('storage/cover/contoh.jpg') }}" alt="">
                </a>
                <a href="#" class="flex flex-col">
                    <img class="w-32 rounded transition-all ease-in-out" src="{{ asset('storage/cover/contoh.jpg') }}" alt="">
                </a>
                <a href="#" class="flex flex-col">
                    <img class="w-32 rounded transition-all ease-in-out" src="{{ asset('storage/cover/contoh.jpg') }}" alt="">
                </a>
                <a href="#" class="flex flex-col">
                    <img class="w-32 rounded transition-all ease-in-out" src="{{ asset('storage/cover/contoh.jpg') }}" alt="">
                </a>
                <a href="#" class="flex flex-col">
                    <img class="w-32 rounded transition-all ease-in-out" src="{{ asset('storage/cover/contoh.jpg') }}" alt="">
                </a>
                <a href="#" class="flex flex-col">
                    <img class="w-32 rounded transition-all ease-in-out" src="{{ asset('storage/cover/contoh.jpg') }}" alt="">
                </a>
                <a href="#" class="flex flex-col">
                    <img class="w-32 rounded transition-all ease-in-out" src="{{ asset('storage/cover/contoh.jpg') }}" alt="">
                </a>
                <a href="#" class="flex flex-col">
                    <img class="w-32 rounded transition-all ease-in-out" src="{{ asset('storage/cover/contoh.jpg') }}" alt="">
                </a>
            </div>
        </div> --}}
        </div>
@endsection