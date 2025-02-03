@extends('peminjam.layout.layout')
@section('content')
    <div class="">
        <div class="flex justify-center items-center">
            <div class="">
                <input type="text" class="w-96 rounded-full border-2 px-4 py-2 border-gray-300 bg-white text-sm focus:outline-blue-900" placeholder="Search...">
            </div>
        </div>
        <div class="flex flex-col mt-4 gap-4">
            <div class="flex">
                <span class="capitalize text-lg font-bold flex text-left">Buku Teratas</span>
            </div>
            <div class="flex gap-4">
                <div class="bg-blue-900 flex w-full items-center rounded">
                    <h1>anu</h1>
                </div>
                <div class="bg-blue-900 flex w-full items-center rounded">
                    <h1>anu</h1>
                </div>
                <div class="bg-blue-900 flex w-full items-center rounded">
                    <h1>anu</h1>
                </div>
                <div class="bg-blue-900 flex w-full items-center rounded">
                    <h1>anu</h1>
                </div>
            </div>
        </div>
    </div>
@endsection