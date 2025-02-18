@extends('peminjam.layout.layout')
@section('content')
<div class="grid gap-10">
    <div class="flex flex-col lg:flex-row gap-8 items-start">
        <div class="w-full lg:w-1/3 flex justify-center">
            <img src="{{ asset('storage/'. ($buku->buku->cover)) }}" alt="Cover Buku" class="lg:w-[70%] w-[50%] rounded bg-cover">
        </div>

        <div class="w-full lg:w-3/4 flex flex-col gap-4 text-sm lg:text-base">
            <div class="text-center lg:text-left">
                <span class="text-xl font-bold">{{ $buku->buku->judul}}</span>
            </div>

            <div>
                <p class="text-justify">{{ $buku->buku->deskripsi}}</p>
            </div>

            <div class="flex flex-col gap-2">
                <div>
                    <span class="font-semibold">Penulis:</span>
                    <span>{{ $buku->buku->penulis}}</span>
                </div>
                <div>
                    <span class="font-semibold">Tahun Terbit:</span>
                    <span>{{ $buku->buku->tahun_terbit}}</span>
                </div>
                <div>
                    <span class="font-semibold">Kategori:</span>
                    <span class="capitalize">{{ $getKategori }}</span>
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
                    <a href="#" class="bg-blue-900 hover:bg-blue-950 text-white py-2 px-20 rounded-full">Pinjam</a>
                    <i class="fa-solid fa-plus text-sm cursor-pointer rounded-full py-2 px-4 border border-gray-300 hover:border-blue-900 bg-white hover:bg-blue-900 flex hover:text-white items-center justify-center transition-all ease-in-out"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="gap-4 grid">
        <div class="text-xl font-bold border-b pb-2">Ulasan {{ "(".$ulasan->count().")" }}</div>
        @if (Empty($ulasanKu)) 
            <form action="{{ route('peminjam.addUlasanAction', $buku->buku->id) }}" method="POST" class="flex gap-3">
                @csrf
                <input type="text" name="ulasan" class="w-full p-2 rounded border bg-gray-100 border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 s" placeholder="Berikan ulasanmu" autocomplete="off">
                <button type="submit" class="bg-blue-900 hover:bg-blue-950 rounded-full py-2 px-5 text-white font-medium">Kirim</button>
            </form>
        @endif
        
        <div class=" grid grid-cols-3 gap-4">
            @if ($ulasanKu) 
                <div class="p-4 bg-gray-100 rounded flex flex-col items-start shadow-sm border border-gray-300">
                    <div class="flex justify-between w-full items-center">
                        <div class="flex w-full gap-1 items-center">
                            <span class="font-semibold text-blue-900">{{ $ulasanKu->peminjam->nama }}</span>
                            <span class="text-xs text-gray-500">-</span>
                            <span class="text-xs text-gray-500">{{ $ulasanKu->created_at->diffForHumans() }}</span>
                        </div>
                        <form action="{{ route('peminjam.destroyUlasan', $buku->buku->id) }}" method="POST" class="">
                            @csrf
                            @method('DELETE')
                            <button type="submit">
                                <i class="fa-solid fa-trash text-sm text-red-500"></i>
                            </button>
                        </form>
                    </div>
                    <div class="">
                        <p class="text-gray-700 text-sm mt-1">{{ $ulasanKu->ulasan }}</p>
                    </div>
                </div>
            @endif
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

<div id="myModal" class="modal hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-end">
    <div class="modal-content bg-white w-full p-6 transition-transform transform translate-y-full">
        <span class="close cursor-pointer text-gray-500 float-right">&times;</span>
        <form action="{{ route('peminjam.addKoleksiAction', $buku->buku->id) }}" method="POST">
            @csrf
            <div class="flex gap-4">
                <div class="flex w-1/6">
                    <img src="{{ asset('storage/'. ($buku->buku->cover)) }}" alt="" class="w-auto rounded">
                </div>
                <div class="w-5/6 flex flex-col gap-4">
                    <div class="grid">
                        <div class="">
                            <span>{{ $buku->buku->judul }}</span>
                        </div>
                        <div class="">
                            <span class="text-sm text-gray-500">{{ "Stok: ".$buku->buku->stok }}</span>
                        </div>
                    </div>
                    <div class="">
                        <button type="submit" class="bg-blue-900 hover:bg-blue-950 text-white py-2 px-4 rounded-full">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById("myModal");
        const btn = document.querySelector(".fa-plus");
        const span = document.getElementsByClassName("close")[0];

        btn.onclick = function() {
            modal.classList.remove("hidden");
            modal.querySelector('.modal-content').classList.remove('translate-y-full');
            modal.querySelector('.modal-content').classList.add('translate-y-0');
        }

        span.onclick = function() {
            closeModal();
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                closeModal();
            }
        }

        function closeModal() {
            const modalContent = modal.querySelector('.modal-content');
            modalContent.classList.remove('translate-y-0');
            modalContent.classList.add('translate-y-full');
            setTimeout(() => {
                modal.classList.add("hidden");
                modalContent.classList.remove('translate-y-full');
            }, 300); 
        }
    });
</script>

@endsection

