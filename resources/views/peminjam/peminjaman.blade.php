@extends('peminjam.layout.layout')
@section('content')
    @if ($peminjaman->isEmpty()) 
        <div class="w-full items-center justify-center flex flex-col">
            <div class="">
                <i class="fa-solid fa-box-open text-6xl text-neutral-400"></i>    
            </div>  
            <div class="">
                <span class="text-neutral-400">Tidak ada peminjaman</span>    
            </div>  
        </div> 
    @else
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            @foreach ($peminjaman as $item) 
                <div class="bg-white p-4 rounded shadow">
                    <div class="flex gap-2">
                        <div class="w-1/6">
                            <div class="p-2 flex items-center">
                                @if (Str::startsWith($item->buku->cover, 'http'))
                                    <img src="{{ $item->buku->cover }}" class="w-full h-full bg-cover rounded transition-all ease-in-out" alt="{{ $item->buku->judul }}">
                                @else
                                    <img src="{{ asset('storage/'. $item->buku->cover) }}" class="w-full h-full bg-cover rounded transition-all ease-in-out" alt="{{ $item->buku->judul }}"> 
                                @endif
                            </div>
                        </div>
                        <div class="flex flex-col w-5/6 justify-start gap-2">
                            <div class="grid">
                                <span class="font-bold">{{ $item->buku->judul }}</span>
                            </div>
                            <div class="grid">
                                <div class="flex text-sm items-center gap-2">
                                    <span>Tanggal pinjam:</span>
                                    <span class="text-neutral-500">{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->translatedFormat('j F Y') }}</span>
                                </div>
                                <div class="flex text-sm items-center gap-2">
                                    <span>Tanggal kembali:</span>
                                    <span class="text-neutral-500">{{ \Carbon\Carbon::parse($item->tanggal_kembali)->translatedFormat('j F Y') }}</span>
                                </div>
                                <div class="flex text-sm items-center gap-2">
                                    <span>Jumlah:</span>
                                    <span class="text-neutral-500">{{ $item->jumlah }}</span>
                                </div>
                                <div class="flex text-sm items-center gap-2">
                                    <span>Status:</span>
                                    @if ($item->status == "dibatalkan") 
                                        <span class="text-red-500 capitalize">Dibatalkan</span>
                                    @else
                                        <span class="text-green-500 capitalize">{{ $item->status }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        @if ($item->status == 'proses' || $item->status == 'siap diambil' || $item->status == 'dibatalkan') 
                            <form id="form-batal-{{ $item->id }}" method="POST" action="{{ route('peminjaman.editStatusPeminjaman', $item->id) }}" class="flex items-center justify-between gap-2">
                                @csrf
                                @method('PUT')
                                @if ($item->status !== 'dibatalkan') 
                                    <input type="text" hidden name="status" value="dibatalkan">
                                    <button type="button" onclick="konfirmasiBatal('{{ $item->id }}')" class="capitalize w-full rounded-full text-center text-white bg-blue-900 hover:bg-blue-950 p-2">Batal peminjaman</button>
                                @else
                                    <span class="capitalize w-full rounded-full text-center text-white bg-red-500 p-2">Menunggu pembatalan</span>
                                @endif
                            </form>
                        @elseif($item->status == 'dipinjam')
                            <div class="flex items-center justify-between gap-2">
                                <span class="capitalize w-full rounded-full text-center text-white bg-blue-900 hover:bg-blue-950 p-2">Pengajuan peminjaman</span>
                            </div>
                        @endif
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
