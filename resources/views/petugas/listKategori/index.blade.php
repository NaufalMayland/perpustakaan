@extends('petugas.layout.layout')
@section('content')
    <div class="bg-white p-4 rounded shadow-md">
        <div class="flex justify-between items-center">
            <div class="font-bold text-lg w-full">
                <span>Data {{ $title }}</span>
            </div>
            <div class="flex gap-2 text-white text-sm w-full">
                <a href="{{ route('petugas.ListKategori.printListKategori') }}" target="_blank" class="p-2 w-full justify-center rounded bg-blue-900 flex gap-1 items-center hover:bg-blue-900">
                    <i class="fa-solid fa-print"></i>
                    <span>Print</span>
                </a>
                <a href="" class="p-2 w-full justify-center rounded bg-blue-900 flex gap-1 items-center hover:bg-blue-900">
                    <i class="fa-solid fa-file-export"></i>
                    <span>Eksport</span>
                </a>
                <a href="{{ route('petugas.LisKategori.importListKategori') }}" class="p-2 w-full justify-center rounded bg-blue-900 flex gap-1 items-center hover:bg-blue-900">
                    <i class="fa-solid fa-file-import"></i>
                    <span>Import</span>
                </a>
                @include('petugas.listKategori.modal.addListKategori')
            </div>
        </div>
        <div class="mt-4">
            <table class="text-sm" id="listKategoriTable">
                <thead class="w-full">
                    <tr>
                        <td class="p-2 text-center font-bold uppercase bg-slate-200">Buku</td>
                        <td class="p-2 text-center font-bold uppercase bg-slate-200">Kategori</td>
                        <td class="p-2 text-center font-bold uppercase bg-slate-200">option</td>
                    </tr>
                </thead>
                <tbody class="w-full">
                    @foreach ($dataListKategori as $data)
                        <tr>
                            <td class="p-2">{{ $data->buku->judul }}</td>
                            <td class="p-2">{{ $data->kategori->kategori }}</td>
                            <td class="p-2 flex gap-2 text-center justify-center">
                                <a href="" class="py-1 px-2 rounded text-center bg-blue-500 text-white">
                                    <i class="fa-solid fa-pencil text-sm"></i>
                                </a>
                                <form id="deleteListKategori" action="{{ route('petugas.listKategori.deleteListKategori', $data->id) }}" method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <button class="py-1 px-2 rounded text-center bg-red-500 text-white" onclick="deleteListKategori()">
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
            $('#listKategoriTable').DataTable();
        } );

        function deleteListKategori() {
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
                document.getElementById('deleteListKategori').submit();
                }
            });
        }
    </script>
@endsection