@extends('petugas.layout.layout')
@section('content')
    <div class="bg-white p-4 rounded shadow">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-lg">Data {{ $title }}</h2>
            <div class="flex gap-2 text-sm">
                <a href="{{ route('petugas.buku.printBuku') }}" target="_blank" class="px-4 py-2 rounded bg-blue-900 text-white flex items-center gap-2 hover:bg-blue-950">
                    <i class="fa-solid fa-print"></i> 
                    <span class="hidden lg:block">Print</span>
                </a>
                <button onclick="openExportModal()" class="px-4 py-2 rounded bg-blue-900 text-white flex items-center gap-2 hover:bg-blue-950">
                    <i class="fa-solid fa-file-export"></i> 
                    <span class="hidden lg:block">Export</span>
                </button>
                <a href="{{ route('petugas.buku.importBuku') }}" class="px-4 py-2 rounded bg-blue-900 text-white flex items-center gap-2 hover:bg-blue-950">
                    <i class="fa-solid fa-file-import"></i> 
                    <span class="hidden lg:block">Import</span>
                </a>
                <a href="{{ route('petugas.buku.addBuku') }}" class="px-4 py-2 rounded bg-blue-900 text-white flex items-center gap-2 hover:bg-blue-950">
                    <i class="fa-solid fa-plus"></i>
                    <span class="hidden lg:block">Tambah</span>
                </a>
                <a href="{{ route('petugas.buku.trashBuku') }}" class="px-4 py-2 rounded bg-red-500 text-white flex items-center gap-2 hover:bg-red-600">
                    <i class="fa-solid fa-trash-can-arrow-up"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="bg-white p-4 rounded shadow mt-4">
        <div class="overflow-x-auto rounded">
            <table id="bukuTable" class="min-w-full border border-gray-400 text-sm">
                <thead class="w-full">
                    <tr class="text-gray-950">
                        <th class="p-2 text-center uppercase relative">Cover</th>
                        <th class="p-2 text-center uppercase relative">Judul</th>
                        <th class="p-2 text-center uppercase relative">Penulis</th>
                        <th class="p-2 text-center uppercase relative">Kode</th>
                        <th class="p-2 text-center uppercase relative">Stok</th>
                        <th class="p-2 text-center uppercase relative">Option</th>
                    </tr>
                </thead>
                <tbody class="w-full">
                    @foreach ($dataBuku as $item)
                        <tr class="border-b border-gray-400 hover:bg-gray-50">
                            <td class="p-2 flex justify-center">
                                @if (Str::startsWith($item->cover, 'http'))
                                    <img src="{{ $item->cover }}" class="w-20 object-cover rounded" alt="{{ $item->judul }}">
                                @else
                                    <img src="{{ asset('storage/' . $item->cover) }}" class="w-20 object-cover rounded" alt="{{ $item->judul }}">
                                @endif
                            </td>
                            <td class="p-2">{{ $item->judul }}</td>
                            <td class="p-2">{{ $item->penulis }}</td>
                            <td class="p-2">{{ $item->kode }}</td>
                            <td class="p-2">{{ $item->stok }}</td>
                            <td class="p-2">
                                <div class="flex gap-2 justify-center items-center">
                                    <a href="{{ route('petugas.buku.detailBuku', $item->slug) }}" class="py-1 px-2 rounded text-center bg-blue-900 hover:bg-blue-950 text-white">
                                        <i class="fa-solid fa-eye text-sm"></i>
                                    </a>
                                    <form id="deleteBuku" action="{{ route('petugas.buku.deleteBuku', $item->id) }}" method="POST" class="">
                                        @csrf
                                        @method('DELETE')
                                        <button class="py-1 px-2 rounded text-center bg-red-500 hover:bg-red-600 text-white" onclick="deleteBuku()">
                                            <i class="fa-solid fa-trash text-sm"></i>    
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div id="exportModal" class="hidden">
        <div class="flex items-center justify-center fixed inset-0 bg-gray-900 bg-opacity-50">
            <div class="bg-white p-4 rounded-lg w-80 text-sm">
                <h3 class="text-lg font-semibold mb-4">Pilih Format Export</h3>
                <form method="GET" action="{{ route('petugas.buku.exportBuku') }}">
                    @csrf
                    <select name="format" class="w-full p-2 rounded border">
                        <option value="pdf">PDF</option>
                        <option value="excel">Excel</option>
                    </select>
                    <div class="flex justify-between mt-4 gap-2">
                        <button type="button" onclick="closeExportModal()" class="px-4 py-2 bg-neutral-500 hover:bg-neutral-600 text-white rounded-full">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-blue-900 hover:bg-blue-950 text-white rounded-full">Export</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#bukuTable').DataTable({
                responsive: true,
                autoWidth: false,
                
            });
        });

        function openExportModal() {
            document.getElementById('exportModal').classList.remove('hidden');
        }

        function closeExportModal() {
            document.getElementById('exportModal').classList.add('hidden');
        }
    </script>
@endsection
