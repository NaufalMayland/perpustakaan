@extends('petugas.layout.layout')
@section('content')
    <form method="POST" action="{{ route('petugas.peminjaman.addPeminjamanAction') }}" class="bg-white p-4 shadow rounded">
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
        <div class="grid gap-4 text-sm mt-4">
            <div class="grid">
                <label for="peminjam">Peminjam</label>
                <input type="email" name="peminjam" id="peminjam" class="w-full py-2 px-2 rounded border bg-gray-100 border-gray-300 text-sm" value="{{ old('peminjam') }}" placeholder="Email peminjam" autocomplete="off" required>
            </div>
            <div class="grid">
                <label for="buku">Buku</label>
                <input type="text" name="buku" id="buku" class="w-full py-2 px-2 rounded border bg-gray-100 border-gray-300 text-sm" value="{{ old('buku') }}" placeholder="Kode buku" autocomplete="off" required>
            </div>
            <div class="grid">
                <label for="petugas">Petugas</label>
                <input type="hidden" name="petugas" id="petugas" value="{{ $petugas->id }}">
                <input type="text" class="w-full py-2 px-2 rounded border bg-gray-100 border-gray-300 text-sm" value="{{ $petugas->nama }}" readonly>
            </div>
            <div class="grid">
                <label for="tanggal_pinjam">Tanggal Peminjaman</label>
                <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" class="w-full py-2 px-2 rounded border bg-gray-100 border-gray-300 text-sm" value="{{ old('tanggal_pinjam') }}" required>
            </div>
            <div class="grid">
                <label for="tanggal_kembali">Tanggal Pengembalian</label>
                <input type="date" name="tanggal_kembali" id="tanggal_kembali" class="w-full py-2 px-2 rounded border bg-gray-100 border-gray-300 text-sm" value="{{ old('tanggal_kembali') }}"  required>
            </div>
            <div class="grid">
                <label for="jumlah">Jumlah</label>
                <div class="flex justify-between items-center border rounded bg-gray-100 border-gray-300 text-sm">
                    <div class="border-r bg-blue-900 hover:bg-blue-950 text-white border-gray-300 px-4 py-2 rounded-l cursor-pointer" onclick="kurangJumlah()">
                        <i class="fa-solid fa-minus"></i>
                    </div>
                    <input type="number" name="jumlah" id="jumlah" class="no-spinner rounded w-full bg-gray-100 p-2 focus:outline-none" value="1" min="1" required>
                    <div class="border-l bg-blue-900 hover:bg-blue-950 text-white border-gray-300 px-4 py-2 rounded-r cursor-pointer" onclick="tambahJumlah()">
                        <i class="fa-solid fa-plus"></i>
                    </div>
                </div>
            </div>
            <div class="grid">
                <label for="status">Status</label>
                <select name="status" id="status" class="w-full py-2 px-2 rounded border bg-gray-100 border-gray-300 text-sm capitalize" required>
                    <option value="" disabled selected hidden>Pilih Status</option>
                    <option value="proses" class="capitalize">proses</option>
                    <option value="siap diambil" class="capitalize">siap diambil</option>
                    <option value="dipinjam" class="capitalize">dipinjam</option>
                    <option value="dikembalikan" class="capitalize">dikembalikan</option>
                </select>
            </div>
        </div>
        <div class="flex justify-end mt-4">
            <button class="bg-blue-900 hover:bg-blue-950 py-2 px-4 text-sm rounded-full text-white">Simpan</button>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tanggalPinjam = document.getElementById('tanggal_pinjam');
            const tanggalKembali = document.getElementById('tanggal_kembali');

            const today = new Date().toISOString().split('T')[0];
            tanggalPinjam.setAttribute('min', today);

            tanggalPinjam.addEventListener('change', function () {
                const selectedDate = new Date(this.value);
                const maxReturnDate = new Date(selectedDate);
                maxReturnDate.setDate(maxReturnDate.getDate() + 7);

                const minReturnDate = this.value;
                const maxReturnDateStr = maxReturnDate.toISOString().split('T')[0];

                tanggalKembali.setAttribute('min', minReturnDate);
                tanggalKembali.setAttribute('max', maxReturnDateStr);
            });
        });
        function kurangJumlah() {
            const jumlah = document.getElementById('jumlah');
            if (jumlah.value > 1) {
                jumlah.value = parseInt(jumlah.value) - 1;
            }
        }

        function tambahJumlah() {
            const jumlah = document.getElementById('jumlah');
            jumlah.value = parseInt(jumlah.value) + 1;
        }
    </script>
@endsection