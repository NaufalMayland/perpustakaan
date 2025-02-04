@extends('petugas.layout.layout')
@section('content')
    <div class="bg-white p-4 rounded shadow-md">
        <div class="mt-4">
            <table class="text-sm" id="dendaTable">
                <thead class="w-full">
                    <tr>
                        <td class="p-2 text-center font-bold uppercase bg-slate-200">Username</td>
                        <td class="p-2 text-center font-bold uppercase bg-slate-200">Email</td>
                        <td class="p-2 text-center font-bold uppercase bg-slate-200">Telepon</td>
                        <td class="p-2 text-center font-bold uppercase bg-slate-200">Hak Akses</td>
                        <td class="p-2 text-center font-bold uppercase bg-slate-200">Option</td>
                    </tr>
                </thead>
                <tbody class="w-full">
                    @foreach ($trash as $item)
                        <tr>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->telepon }} @if ($item->telepon == null) - @endif</td>
                            <td>{{ $item->role }}</td>
                            <td class="p-2">
                                <div class="flex gap-2 justify-center items-center">
                                    <form id="restorePetugas" action="{{ route('petugas.user.dpetugas.restorePetugas', $item->id) }}" method="POST" class="">
                                        @csrf
                                        <button class="py-1 px-2 rounded text-center bg-blue-900 hover:bg-blue-950 text-white" onclick="restorePetugas()">
                                            <i class="fa-solid fa-recycle"></i>
                                        </button>
                                    </form>
                                    <form id="destroyPetugas" action="{{ route('petugas.user.dpetugas.destroyPetugas', $item->id) }}" method="POST" class="">
                                        @csrf
                                        @method('DELETE')
                                        <button class="py-1 px-2 rounded text-center bg-red-500 hover:bg-red-600 text-white" onclick="destroyPetugas()">
                                            <i class="fa-solid fa-trash"></i>  
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

    <script>
        $(document).ready( function () {
            $('#dendaTable').DataTable();
            
        } );
    </script>
@endsection