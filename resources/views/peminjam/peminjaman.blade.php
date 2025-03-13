@extends('peminjam.layout.layout')
@section('content')
    @if ($peminjaman->isEmpty()) 
        <div class="flex flex-col items-center justify-center h-64">
            <i class="fa-solid fa-box-open text-6xl text-neutral-400"></i>    
            <span class="text-neutral-400 mt-4">Tidak ada peminjaman</span>    
        </div> 
    @else
        <div class="grid w-full lg:flex gap-2">
            @foreach ($peminjaman as $item) 
                <div class="relative bg-white p-4 shadow rounded w-80">
                    <span class="absolute top-0 text-sm right-0 bg-green-500 text-white px-3 py-2 rounded-l-full capitalize">{{ $item->status }}</span>
                    <div class="grid gap-4">
                        <div class="w-full rounded flex justify-center">
                            @if (Str::startsWith($item->buku->cover, 'http'))
                                <img src="{{ $item->buku->cover }}" class="object-cover w-40 rounded" alt="{{ $item->buku->judul }}">
                            @else
                                <img src="{{ asset('storage/'. $item->buku->cover) }}" class="object-cover w-40 rounded" alt="{{ $item->buku->judul }}"> 
                            @endif
                        </div>
                        <div class="grid gap-2">
                            <div class="truncate">
                                <h3 class="font-bold text-left truncate">{{ $item->buku->judul }}</h3>
                            </div>
                            <div class="text-sm text-neutral-500 text-left">
                                <div>
                                    <span class="font-bold">Tanggal pinjam: </span>
                                    <span>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->translatedFormat('j F Y') }}</span>
                                </div>
                                <div>
                                    <span class="font-bold">Tanggal kembali: </span>
                                    <span>{{ \Carbon\Carbon::parse($item->tanggal_kembali)->translatedFormat('j F Y') }}</span>
                                </div>
                                <div>
                                    <span class="font-bold">Jumlah:</span>
                                     <span>{{ $item->jumlah }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-center text-center gap-2">
                            @if ($item->status == "proses" || $item->status == "siap diambil" || $item->status == "dibatalkan")
                                <form id="form-batal-{{ $item->id }}" method="POST" action="{{ route('peminjaman.editStatusPeminjaman', $item->id) }}" class="flex items-center justify-between gap-2">
                                    @csrf
                                    @method('PUT')
                                    @if ($item->status !== 'dibatalkan') 
                                        <input type="text" hidden name="status" value="dibatalkan">
                                        <button type="button" onclick="konfirmasiBatal('{{ $item->id }}')" class="capitalize w-full rounded-full text-center border border-red-500 text-red-500 hover:text-white bg-white hover:bg-red-500 py-2 px-3 flex items-center gap-1">
                                            <i class="fa-solid fa-xmark"></i>
                                            <span>Batal</span>
                                        </button>
                                    @else
                                        <span class="capitalize w-full rounded-full text-center text-white bg-red-500 py-2 px-3">Pembatalan</span>
                                    @endif
                                </form>
                            @endif
                            <a href="{{ route('peminjam.detailPeminjaman', $item->id) }}" class="flex justify-center items-center bg-blue-900 hover:bg-blue-950 py-2 px-3 gap-1 rounded-full text-white">
                                <i class="fa-solid fa-eye"></i>
                                <span>Detail</span>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

<script>
    function konfirmasiBatal(id) {
        Swal.fire({
            title: 'Batalkan peminjaman?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#1E3A8A',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, batalkan!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('form-batal-' + id).submit();
            }
        })
    }
</script>
@endsection