@extends('petugas.layout.layout')
@section('content')
    <form method="POST" action="{{ route('petugas.listKategori.addListKategoriAction') }}" class="bg-white p-4 shadow-md rounded" enctype="multipart/form-data">
        @csrf
        @if ($errors->any())
            <div class="bg-red-500 text-white text-sm p-3 rounded text-center w-full">
                <ul>
                    @foreach ($errors->all() as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="grid gap-2 text-sm mt-4">
            <div class="grid">
                <label for="buku">Buku</label>
                <select name="buku" id="buku" class="w-full p-2 rounded border bg-gray-100 border-gray-300 text-sm">
                    <option value="" disabled selected hidden>Pilih buku</option>
                    @foreach ($dataBuku as $item)
                        <option value="{{ $item->id }}">{{ $item->kode.' - '.$item->judul }}</option>
                    @endforeach
                </select>
            </div>
            <div class="grid">
                <label for="kategori">Kategori</label>
                <select name="kategori" id="kategori" class="w-full p-2 capitalize rounded border bg-gray-100 border-gray-300 text-sm">
                    <option value="" disabled selected hidden>Pilih kategori</option>
                    @foreach ($dataKategori as $item)
                        <option class="capitalize" value="{{ $item->id }}">{{ $item->kategori}}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex justify-end">
                <button class="bg-blue-900 py-2 px-3 text-sm rounded text-white">Tambah</button>
            </div>
        </div>
    </form>
@endsection