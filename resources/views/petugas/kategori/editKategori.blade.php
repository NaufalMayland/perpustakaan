@extends('petugas.layout.layout')
@section('content')
    <form method="POST" action="{{ route('petugas.kategori.editKategoriAction', $kategori->id) }}" class="bg-white p-4 shadow-md rounded" enctype="multipart/form-data">
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
                <label for="kategori">Kategori</label>
                <input type="text" name="kategori" id="kategori" class="w-full p-2 rounded border bg-gray-100 border-gray-300 text-sm" value="{{ $kategori->kategori }}" placeholder="Masukan judul buku" autocomplete="off" required>
            </div>
            <div class="flex justify-end">
                <button class="bg-blue-900 py-2 px-3 text-sm rounded text-white">Simpan</button>
            </div>
        </div>
    </form>
@endsection