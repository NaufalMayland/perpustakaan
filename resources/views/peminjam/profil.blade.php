@extends('peminjam.layout.layout')
@section('content')
    <div class="flex flex-col lg:flex-row gap-8 items-start">
        <div class="w-full lg:w-1/3 flex justify-center">
            <img src="" alt="Cover Buku" class="w-[70%] rounded bg-cover">
        </div>

        <div class="w-full lg:w-3/4 flex flex-col gap-4 text-sm lg:text-base">
            <div class="text-center lg:text-left">
                <span class="text-xl font-bold"></span>
            </div>

            <div>
                <p class="text-justify"></p>
            </div>

            <div class="flex flex-col gap-2">
                <div>
                    <span class="font-semibold">Penulis:</span>
                    <span></span>
                </div>
                <div>
                    <span class="font-semibold">Tahun Terbit:</span>
                    <span></span>
                </div>
                <div>
                    <span class="font-semibold">Kategori:</span>
                    <span class="capitalize"></span>
                </div>
            </div>
        </div>
    </div>
@endsection
