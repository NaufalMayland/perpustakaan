@extends('petugas.layout.layout')
@section('content')
    <div class="bg-white p-4 rounded shadow-md">
        <div class="flex justify-between items-center">
            <div class="font-bold text-lg w-full">
                <span>Data {{ $title }}</span>
            </div>
            <div class="flex gap-2 text-white text-sm w-full">
                <a href="{{ route('petugas.buku.printBuku') }}" target="_blank" class="p-2 w-full justify-center rounded bg-blue-900 flex gap-1 items-center hover:bg-blue-900">
                    <i class="fa-solid fa-print"></i>
                    <span>Print</span>
                </a>
                <a href="" class="p-2 w-full justify-center rounded bg-blue-900 flex gap-1 items-center hover:bg-blue-900">
                    <i class="fa-solid fa-file-export"></i>
                    <span>Eksport</span>
                </a>
                <a href="{{ route('petugas.buku.importBuku') }}" class="p-2 w-full justify-center rounded bg-blue-900 flex gap-1 items-center hover:bg-blue-900">
                    <i class="fa-solid fa-file-import"></i>
                    <span>Import</span>
                </a>
                <a href="{{ route('petugas.buku.addBuku') }}" class="p-2 w-full justify-center rounded bg-blue-900 flex gap-1 items-center hover:bg-blue-900">
                    <i class="fa-solid fa-plus"></i>
                    <span>Tambah</span>
                </a>
            </div>
        </div>
        <div class="mt-4">
            <table class="text-sm" id="bukuTable">
                <thead class="w-full">
                    <tr>
                        <td class="p-2 text-center font-bold uppercase bg-slate-200">Judul</td>
                        <td class="p-2 text-center font-bold uppercase bg-slate-200">Penulis</td>
                        <td class="p-2 text-center font-bold uppercase bg-slate-200">Penerbit</td>
                        <td class="p-2 text-center font-bold uppercase bg-slate-200">Tahun Terbit</td>
                        <td class="p-2 text-center font-bold uppercase bg-slate-200">Deskripsi</td>
                        <td class="p-2 text-center font-bold uppercase bg-slate-200">Kode</td>
                        <td class="p-2 text-center font-bold uppercase bg-slate-200">Stok</td>
                        <td class="p-2 text-center font-bold uppercase bg-slate-200">Option</td>
                    </tr>
                </thead>
                <tbody class="w-full">
                    @foreach ($dataBuku as $data)
                        <tr>
                            <td class="p-2">{{ $data->judul }}</td>
                            <td class="p-2">{{ $data->penulis }}</td>
                            <td class="p-2">{{ $data->penerbit }}</td>
                            <td class="p-2">{{ $data->tahun_terbit }}</td>
                            <td class="p-2">{{ $data->deskripsi }}</td>
                            <td class="p-2">{{ $data->kode }}</td>
                            <td class="p-2">{{ $data->stok }}</td>
                            <td class="p-2 flex gap-2 text-center justify-center">
                                <a href="" class="py-1 px-2 rounded text-center bg-blue-500 text-white">
                                    <i class="fa-solid fa-pencil text-sm"></i>
                                </a>
                                <form id="deleteBuku" action="{{ route('petugas.buku.deleteBuku', $data->id) }}" method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <button class="py-1 px-2 rounded text-center bg-red-500 text-white" onclick="deleteUser()">
                                    <i class="fa-solid fa-trash text-sm"></i>    
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready( function () {
            $('#bukuTable').DataTable();
        } );

        function deleteUser() {
            Swal.fire({
            title: 'Hapus',
            text: "Anda yakin untuk logout?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#2563eb',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
            })
            .then((result) => {
                if (result.isConfirmed) {
                document.getElementById('deleteBuku').submit();
                }
            });
        }
    </script>
@endsection