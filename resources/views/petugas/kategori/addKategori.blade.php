@extends('petugas.layout.layout')
@section('content')
    <form method="POST" action="{{ route('petugas.kategori.addKategoriAction') }}" class="bg-white p-4 shadow rounded" enctype="multipart/form-data">
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
                <label class="mb-1" for="kategori">Kategori</label>
                <input type="text" name="kategori" id="kategori" class="w-full p-2 rounded border bg-gray-100 border-gray-300 text-sm" value="{{ old('kategori') }}" placeholder="Masukan judul buku" autocomplete="off" required>
            </div>
            <div class="flex justify-end">
                <button class="bg-blue-900 py-2 px-3 text-sm rounded-full text-white">Tambah</button>
            </div>
        </div>
    </form>
@endsection