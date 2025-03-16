@extends('peminjam.layout.layout')
@section('content')
    <div class="grid gap-10">
        <div class="flex flex-col lg:flex-row gap-8 items-start">
            <div class="w-full lg:w-1/5 flex justify-center">
                @if (Str::startsWith($buku->buku->cover, 'http'))
                    <img src="{{ $buku->buku->cover }}" class="lg:w-auto rounded bg-cover" alt="{{ $buku->buku->judul }}">
                @else
                    <img src="{{ asset('storage/' . $buku->buku->cover) }}" class="lg:w-auto rounded bg-cover" alt="{{ $buku->buku->judul }}">
                @endif
            </div>

            <div class="w-full lg:w-4/5 flex flex-col gap-4 text-sm lg:text-base">
                <div class="text-center lg:text-left">
                    <span class="text-xl font-bold">{{ $buku->buku->judul}}</span>
                </div>
                <div>
                    <p class="text-justify">{{ $buku->buku->deskripsi}}</p>
                </div>

                <div class="flex flex-col gap-2">
                    <div>
                        <span class="font-bold">Penulis:</span>
                        <span>{{ $buku->buku->penulis}}</span>
                    </div>
                    <div>
                        <span class="font-bold">Tahun Terbit:</span>
                        <span>{{ $buku->buku->tahun_terbit}}</span>
                    </div>
                    <div>
                        <span class="font-bold">Kategori:</span>
                        <span class="capitalize">{{ $getKategori }}</span>
                    </div>
                    <div>
                        <span class="font-bold">Stok:</span>
                        <span class="capitalize">{{ $buku->buku->stok }}</span>
                    </div>
                </div>
                
                <div class="justify-between flex w-full">
                    <div class="flex flex-row mt-2 gap-4 items-center text-sm">
                        <a href="" class="bg-blue-900 hover:bg-blue-950 text-white flex w-full items-center gap-2 py-2 px-4 rounded-full">
                            <i class="fa-solid fa-arrow-left text-sm"></i>
                            <span>Kembali</span>
                        </a>
                    </div>
                    <div class="flex flex-row mt-2 gap-4 items-center lg:text-base">
                        @if ($buku->buku->stok == '0')
                            <span class="bg-neutral-500 text-white py-2 px-20 rounded-full">Stok habis</span>
                        @else 
                            @include('peminjam.modal.addPeminjaman')
                            @include('peminjam.modal.addKoleksi')
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="gap-4 grid">
            <div class="text-xl font-bold border-b pb-2">
                <span>Ulasan{{ "(".$ulasanCount.")" }}</span>
            </div>

            <form action="{{ route('peminjam.addUlasanAction', $buku->buku->id) }}" method="POST" class="flex gap-3">
                @csrf
                <input type="text" name="ulasan" class="w-full p-2 rounded border bg-gray-100 border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 s" placeholder="Berikan ulasanmu" autocomplete="off">
                <button type="submit" class="bg-blue-900 hover:bg-blue-950 rounded-full py-2 px-5 text-white font-medium">Kirim</button>
            </form>
            
            <div class=" grid grid-cols-3 gap-4">
                @foreach ($ulasanKu as $item) 
                    <div class="p-4 bg-gray-100 rounded flex flex-col items-start shadow-sm border border-gray-300">
                        <div class="flex justify-between w-full items-center">
                            <div class="flex w-full gap-1 items-center">
                                <span class="font-semibold text-blue-900">{{ $item->peminjam->nama }}</span>
                                <span class="text-xs text-gray-500">-</span>
                                <span class="text-xs text-gray-500">{{ $item->created_at->diffForHumans() }}</span>
                            </div>
                            <form action="{{ route('peminjam.destroyUlasan', $item->id) }}" method="POST" class="">
                                @csrf
                                @method('DELETE')
                                <button type="submit">
                                    <i class="fa-solid fa-trash text-sm text-red-500"></i>
                                </button>
                            </form>
                        </div>
                        <div class="">
                            <p class="text-gray-700 text-sm mt-1">{{ $item->ulasan }}</p>
                        </div>
                    </div>
                @endforeach
                @foreach ($ulasan as $item)
                    <div class="p-4 bg-gray-100 rounded flex flex-col items-start shadow-sm border border-gray-300">
                        <div class="flex justify-between w-full items-center">
                            <div class="flex w-full gap-1 items-center">
                                <span class="font-semibold text-blue-900">{{ $item->peminjam->nama }}</span>
                                <span class="text-xs text-gray-500">-</span>
                                <span class="text-xs text-gray-500">{{ $item->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        <div class="">
                            <p class="text-gray-700 text-sm mt-1">{{ $item->ulasan }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

