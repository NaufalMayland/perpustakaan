@extends('petugas.layout.layout')
@section('content')
    <form method="POST" action="{{ route('petugas.listKategori.editListKategoriAction', $buku->id) }}" class="bg-white p-4 shadow rounded" enctype="multipart/form-data">
        @csrf
        @method('PUT')
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
                <input type="text" name="buku" id="buku"  class="w-full p-2 rounded border bg-gray-100 border-gray-300 text-sm focus:outline-none" value="{{ $buku->kode.' - '.$buku->judul }}" readonly>
                {{-- <select name="buku" id="buku" class="w-full p-2 rounded border bg-gray-100 border-gray-300 text-sm">
                    <option value="{{ $buku->id }}">{{ $buku->kode.' - '.$buku->judul }}</option>
                </select> --}}
            </div>
            <div class="grid">
                <label class="mb-1" for="kategori">Kategori</label>
                <div class="flex flex-wrap gap-2">
                    @foreach ($kategori as $item) 
                        <div class="flex items-center space-x-2">
                            <input type="radio" name="kategori" id="kategori_{{ $item->id }}" value="{{ $item->id }}" class="peer" {{ $item->id == $selectedKategori->id_kategori ? 'checked' : '' }} hidden>
                            <label for="kategori_{{ $item->id }}" class="flex items-center w-auto px-4 py-1 border border-gray-300 rounded-full capitalize cursor-pointer text-sm bg-gray-100 text-black peer-checked:bg-blue-900 peer-checked:text-white peer-checked:border-blue-900 transition-all duration-100">
                                {{ $item->kategori }}
                            </label>
                        </div>
                    @endforeach
                </div>                
            </div>
            <div class="flex justify-end">
                <button class="bg-blue-900 py-2 px-3 text-sm rounded-full text-white">Simpan</button>
            </div>
        </div>
    </form>
@endsection