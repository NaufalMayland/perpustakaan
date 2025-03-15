@extends('petugas.layout.layout')
@section('content')
    <div class="gap-4 grid">
        <div class="grid grid-cols-3 justify-between items-center gap-4">
            <a href="{{ route('petugas.buku.index') }}" class="bg-white border-r-2 grid gap-2 items-end border-red-600 rounded shadow p-4">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-book text-blue-900"></i>
                    <span>Data buku</span>
                </div>
                <div class="flex items-center justify-center">
                    <span class="text-xl font-bold">{{ $buku->count() }}</span>
                </div>
            </a>
            <a href="{{ route('petugas.peminjaman.index') }}" class="bg-white border-r-2 grid gap-2 items-end border-green-600 rounded shadow p-4">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-handshake text-blue-900"></i>
                    <span>Peminjaman bulan ini</span>
                </div>
                <div class="flex items-center justify-center">
                    <span class="text-xl font-bold">{{ $peminjaman->count() }}</span>
                </div>
            </a>
            <a href="{{ route('petugas.denda.index') }}" class="bg-white border-r-2 grid gap-2 items-end border-yellow-500 rounded shadow p-4">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-money-bill-wave text-blue-900"></i>
                    <span>Denda</span>
                </div>
                <div class="flex items-center justify-center">
                    <span class="text-xl font-bold">{{ $denda->count() }}</span>
                </div>
            </a>
        </div>
        <div class="bg-white p-4 rounded shadow mt-4">
            <div class="flex justify-start mb-4">
                <span class="text-lg font-semibold uppercase">Peminjaman Hari Ini</span>
            </div>
            <div class="overflow-x-auto">
                <table id="peminjamanTable" class="min-w-full lg:w-full table-auto border border-gray-400 text-sm">
                    <thead class="w-full">
                        <tr class="text-gray-950">
                            <th class="p-2 text-center uppercase">Peminjam</th>
                            <th class="p-2 text-center uppercase">Buku</th>
                            <th class="p-2 text-center uppercase">Jumlah</th>
                            <th class="p-2 text-center uppercase">Tanggal Pinjam</th>
                            <th class="p-2 text-center uppercase">Tanggal Kembali</th>
                            <th class="p-2 text-center uppercase">Tanggal Dikembalikan</th>
                            <th class="p-2 text-center uppercase">Perpanjangan</th>
                            <th class="p-2 text-center uppercase">Status</th>
                        </tr>
                    </thead>
                    <tbody class="w-full">
                        @foreach ($peminjamanToday as $item)
                            <tr class="border-b border-gray-400 hover:bg-gray-50">
                                <td class="p-2 text-left">{{ $item->peminjam->nama }}</td>
                                <td class="p-2 text-left">{{ $item->buku->judul }}</td>
                                <td class="p-2 text-left">{{ $item->jumlah }}</td>
                                <td class="p-2 text-left">{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->translatedFormat('j F Y') }}</td>
                                <td class="p-2 text-left">{{ \Carbon\Carbon::parse($item->tanggal_kembali)->translatedFormat('j F Y') }}</td>
                                <td class="p-2 text-left">{{ $item->tanggal_dikembalikan ? \Carbon\Carbon::parse($item->tanggal_dikembalikan)->translatedFormat('j F Y') : "-" }}</td>
                                <td class="p-2 text-left">{{ $item->perpanjangan ? $item->perpanjangan." Hari" : "-"}}</td>
                                @if ($sesPetugas->role == 'admin') 
                                    <td class="p-2 text-left capitalize">{{ $item->status }}</td>
                                @elseif($sesPetugas->role == 'petugas')
                                    <td class="p-2 text-left">
                                        @if ($item->status == "dibatalkan")
                                            <form action="{{ route('petugas.peminjaman.destroyPeminjaman', $item->id) }}" method="POST" class="flex gap-2 items-center justify-center">
                                                @csrf
                                                @method('DELETE')
                                                <div class="">
                                                    <span class="text-red-600 rounded p-2">Pembatalan</span>
                                                </div>
                                                <div class="">
                                                    <button type="submit" class="fa-solid fa-check text-white bg-blue-900 hover:bg-blue-950 rounded p-2"></button>
                                                </div>
                                            </form>
                                        @elseif($item->status == "menunggu perpanjangan")
                                            <form action="{{ route('petugas.peminjaman.perpanjangan', $item->id) }}" method="POST" class="flex gap-2 items-center justify-center">
                                                @csrf
                                                @method('PUT')
                                                <div class="">
                                                    <span class="text-blue-900 rounded p-2">{{ 'Perpanjang '. $item->perpanjangan .' Hari'  }}</span>
                                                </div>
                                                <div class="">
                                                    <button type="submit" class="fa-solid fa-check text-white bg-blue-900 hover:bg-blue-950 rounded p-2"></button>
                                                </div>
                                            </form>
                                        @else
                                            <form action="{{ route('petugas.peminjaman.editStatusPeminjaman', $item->id) }}" method="POST" id="form-status-{{ $item->id }}" class="flex gap-2 justify-center items-center">
                                                @csrf
                                                @method('PUT')
                                                <select name="status" id="status-{{ $item->id }}" class="capitalize border border-neutral-500 p-1 bg-white rounded focus:outline-none" 
                                                    data-id="{{ $item->id }}">
                                                    <option class="capitalize" value="proses" {{ $item->status == 'proses' ? 'selected' : '' }}>proses</option>
                                                    <option class="capitalize" value="siap diambil" {{ $item->status == 'siap diambil' ? 'selected' : '' }}>siap diambil</option>
                                                    <option class="capitalize" value="dipinjam" {{ $item->status == 'dipinjam' ? 'selected' : '' }}>dipinjam</option>
                                                    <option class="capitalize" value="diperpanjang" {{ $item->status == 'diperpanjang' ? 'selected' : '' }} disable hidden>diperpanjang</option>
                                                    <option class="capitalize" value="dikembalikan" {{ $item->status == 'dikembalikan' ? 'selected' : '' }}>dikembalikan</option>
                                                </select>
                                            </form>
                                        @endif
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#peminjamanTable').DataTable({
                responsive: true,
                autoWidth: false,
            });

            $('select[name="status"]').change(function() {
                if ($(this).val() === 'dikembalikan') {
                    const peminjamanId = $(this).data('id');

                    $('#dendaForm').attr('action', $(this).closest('form').attr('action'));

                    $('#dendaForm').append(`<input type="hidden" name="peminjaman_id" value="${peminjamanId}">`);

                    $('#dendaModal').removeClass('hidden');
                } else {
                    $(this).closest('form').submit();
                }
            });
        });

        function toggleDendaInput(radio) {
            if (radio.value === 'ya') {
                $('#dendaInput').removeClass('hidden');
            } else {
                $('#dendaInput').addClass('hidden');
            }
        }

        function closeModal() {
            $('#dendaModal').addClass('hidden');
        }
        
        function openExportModal() {
            document.getElementById('exportModal').classList.remove('hidden');
        }

        function closeExportModal() {
            document.getElementById('exportModal').classList.add('hidden');
        }
    </script>
@endsection