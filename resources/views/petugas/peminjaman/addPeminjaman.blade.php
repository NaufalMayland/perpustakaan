@extends('petugas.layout.layout')
@section('content')
    <form method="POST" action="" class="bg-white p-4 shadow-md rounded">
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
        <div class="grid grid-cols-2 gap-4 text-sm mt-4">
            <div class="grid">
                <label for="peminjam">Peminjam</label>
                <input type="text" name="peminjam" id="peminjam" class="w-full py-2 px-2 rounded border bg-gray-100 border-gray-300 text-sm" value="{{ old('peminjam') }}" required>
            </div>
            <div class="grid">
                <label for="buku">Buku</label>
                <input type="text" name="buku" id="buku" class="w-full py-2 px-2 rounded border bg-gray-100 border-gray-300 text-sm" value="{{ old('buku') }}" required>
            </div>
            <div class="grid">
                <label for="petugas">Petugas</label>
                <input type="hidden" name="petugas" id="petugas" value="{{ $petugas->id }}">
                <input type="text" class="w-full py-2 px-2 rounded border bg-gray-100 border-gray-300 text-sm" value="{{ $petugas->nama }}" readonly>
            </div>
            <div class="grid">
                <label for="tanggal_peminjaman">Tanggal Peminjaman</label>
                <input type="date" name="tanggal_peminjaman" id="tanggal_peminjaman" class="w-full py-2 px-2 rounded border bg-gray-100 border-gray-300 text-sm" value="{{ old('tanggal_peminjaman') }}" required>
            </div>
            <div class="grid">
                <label for="tanggal_pengembalian">Tanggal Pengembalian</label>
                <input type="date" name="tanggal_pengembalian" id="tanggal_pengembalian" class="w-full py-2 px-2 rounded border bg-gray-100 border-gray-300 text-sm" value="{{ old('tanggal_pengembalian') }}"  required>
            </div>
            {{-- <div class="grid">
                <label for="tanggal_pengembalian">Tanggal Dikembalikan</label>
                <input type="date" name="tanggal_pengembalian" id="tanggal_pengembalian" class="w-full py-2 px-2 rounded border bg-gray-100 border-gray-300 text-sm" value="{{ old('tanggal_pengembalian') }}">
            </div> --}}
            <div class="grid">
                <label for="status">Status</label>
                <select name="status" id="status" class="w-full py-2 px-2 rounded border bg-gray-100 border-gray-300 text-sm capitalize">
                    <option value="" disabled selected hidden>Status</option>
                    <option value="proses" class="capitalize">proses</option>
                    <option value="dipinjam" class="capitalize">dipinjam</option>
                    <option value="dikembalikan" class="capitalize">dikembalikan</option>
                </select>
                {{-- <input type="number" name="status" id="status" class="w-full py-2 px-2 rounded border bg-gray-100 border-gray-300 text-sm" value="{{ old('status') }}"> --}}
            </div>
        </div>
        <div class="flex justify-end mt-4">
            <button class="bg-blue-900 py-2 px-3 text-sm rounded text-white">Simpan</button>
        </div>
    </form>
@endsection