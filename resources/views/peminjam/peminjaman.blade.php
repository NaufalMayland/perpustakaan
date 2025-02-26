@extends('peminjam.layout.layout')
@section('content')
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
                    <div class="flex flex-col w-5/6 justify-start lg:justify-between">
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
                                <span class="text-green-500 capitalize">{{ $item->status }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <form method="POST" action="{{ route('peminjam.batalPeminjaman', $item->id) }}" class="flex items-center justify-between gap-2 mt-4">
                    @csrf
                    @method('DELETE')
                    @if ($item->deleted_at == null)
                        <button type="submit" class="capitalize w-full rounded text-center text-blue hover:text-white bg-white border border-blue-900 hover:bg-blue-900 p-2">Batalkan</button>
                    @else
                        <span class="capitalize w-full rounded text-center text-white bg-blue-900 p-2">Menunggu pembatalan</span>
                    @endif
                </form>
            </div>
        @endforeach
    </div>
@endsection