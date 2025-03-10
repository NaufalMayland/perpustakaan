<button koleksi-modal-target="#koleksiModal" class="fa-solid fa-plus text-sm cursor-pointer rounded-full py-2 px-4 border border-gray-300 hover:border-blue-900 bg-white hover:bg-blue-900 flex hover:text-white items-center justify-center transition-all ease-in-out"></button>

<div id="koleksiOverlay" class="fixed inset-0 bg-black bg-opacity-25 hidden min-h-screen z-30"></div>

<div class="z-40 inset-0 hidden fixed " id="koleksiModal">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white flex flex-col-reverse lg:flex-row rounded w-80 lg:w-auto">
            <form id="koleksiForm" action="{{ route('peminjam.addKoleksiAction', $buku->buku->id) }}" method="POST" enctype="multipart/form-data" class="items-center grid gap-4 p-4">
                @csrf
                <div class="flex flex-col lg:flex-row gap-4">
                    <div class="w-full lg:w-1/3 ">
                        <div class="w-full h-full flex justify-center items-center">
                            @if (Str::startsWith($buku->buku->cover, 'http'))
                                <img src="{{ $buku->buku->cover }}" class="w-40 flex items-center rounded bg-cover" alt="{{ $buku->buku->judul }}">
                            @else
                                <img src="{{ asset('storage/' . $buku->buku->cover) }}" class="w-40 flex items-center rounded bg-cover" alt="{{ $buku->buku->judul }}">
                            @endif
                        </div>
                    </div>
                    <div class="w-full lg:w-2/3 flex flex-col justify-between gap-4 text-sm lg:text-base">
                        <div class="flex justify-center lg:justify-between items-start">
                            <div class="text-center lg:text-left grid">
                                <span class="text-xl text-center lg:text-left font-bold">{{ $buku->buku->judul}}</span>
                                <span class="text-neutral-500 text-sm text-center lg:text-left">{{ "Stok: ".$buku->buku->stok}}</span>
                            </div>
                            <div class="justify-end items-start hidden lg:flex">
                                <a class="fa-solid fa-xmark text-neutral-500 cursor-pointer text-sm" onclick="closeFormKoleksi()"></a>
                            </div>
                        </div>
                        <div class="items-end flex w-full">
                            <button type="submit" class="rounded-full bg-blue-900 hover:bg-blue-950 w-full text-white px-3 py-2">Simpan koleksi</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>    
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const button = document.querySelector('[koleksi-modal-target]');
        const modal = document.querySelector(button.getAttribute('koleksi-modal-target'));
        const overlay = document.getElementById('koleksiOverlay');
        const form = document.getElementById('koleksiForm');

        button.addEventListener('click', function () {
            modal.classList.remove('hidden');
            overlay.classList.remove('hidden');
        });

    });

    function closeFormKoleksi() {
        document.getElementById('koleksiModal').classList.add('hidden');
        document.getElementById('koleksiOverlay').classList.add('hidden');
    }
</script>