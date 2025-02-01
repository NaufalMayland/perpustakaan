@extends('petugas.layout.layout')
@section('content')
    <form method="POST" action="" class="bg-white p-4 shadow-md rounded">
        @csrf
        @if ($errors->any())
            <div class="bg-red-500 text-white text-sm p-3 rounded text-left w-full">
                <ul>
                    @foreach ($errors->all() as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="grid gap-2">
            <div class="flex w-full">
                <input type="file" class="w-full border tetx-sm rounded file:border-none cursor-pointer file:cursor-pointer file:py-2 file:px-3 file:mr-2 file:text-white file:bg-blue-900 file:text-sm">
            </div>
            <div class="flex w-full gap-2">
                <a href="" class="w-full bg-blue-900 py-2 px-3 flex text-sm rounded text-center justify-center gap-2 items-center hover:bg-blue-900 text-white">
                    <i class="fa-solid fa-download"></i>
                    <span>Download Template</span>
                </a>
                <button type="submit" class="w-full bg-blue-900 py-2 px-3 text-sm rounded text-center items-center hover:bg-blue-900 text-white">Import</button>
            </div>
        </div>
    </form>
@endsection