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
                <label class="mb-1" for="buku">Buku</label>
                <select name="buku" id="buku" class="w-full p-2 rounded border bg-gray-100 border-gray-300 text-sm" required>
                    <option value="" disabled selected hidden>Pilih buku</option>
                    @foreach ($dataBuku as $item)
                        <option value="{{ $item->id }}">{{ $item->kode.' - '.$item->judul }}</option>
                    @endforeach
                </select>
            </div>
            <div class="grid">
                <label class="mb-1" for="kategori">Kategori</label>
                <div class="flex flex-wrap gap-2">
                    @foreach ($dataKategori as $item) 
                    <div class="flex items-center space-x-2">
                        <input type="checkbox" name="kategori[]" id="kategori_{{ $item->id }}" value="{{ $item->id }}" class="peer" hidden required>
                        <label for="kategori_{{ $item->id }}" class="flex items-center w-auto px-4 py-1 border border-gray-300 rounded-full capitalize cursor-pointer text-sm bg-gray-100 text-black peer-checked:bg-blue-900 peer-checked:text-white peer-checked:border-blue-900 transition-all duration-100">
                            {{ $item->kategori }}
                        </label>
                    </div>
                    @endforeach
                </div>                
            </div>
            <div class="flex justify-end">
                <button class="bg-blue-900 py-2 px-3 text-sm rounded text-white">Tambah</button>
            </div>
        </div>
    </form>
@endsection