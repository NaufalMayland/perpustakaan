<button pinjam-modal-target="#pinjamModal" class="bg-blue-900 hover:bg-blue-950 text-white py-2 px-20 rounded-full">Pinjam</button>

<div id="pinjamOverlay" class="fixed inset-0 bg-black bg-opacity-25 hidden min-h-screen"></div>

<div class="z-50 inset-0 hidden fixed " id="pinjamModal">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white flex flex-col-reverse lg:flex-row rounded w-80 lg:w-auto">
            <form id="pinjamForm" action="{{ route('peminjam.addPeminjamanAction', $buku->buku->id) }}" method="POST" enctype="multipart/form-data" class="items-center grid gap-4 p-4">
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
                                <a class="fa-solid fa-xmark text-neutral-500 cursor-pointer text-sm" onclick="closeFormPinjam()"></a>
                            </div>
                        </div>
                        <div class="grid gap-4 w-full">
                            <div class="grid">
                                <label for="tanggal_pinjam">Tanggal pinjam</label>
                                <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" class="w-full p-2 rounded border bg-gray-100 border-gray-300 text-sm" required>
                            </div>
                            <div class="grid">
                                <label for="tanggal_kembali">Tanggal kembali</label>
                                <input type="date" name="tanggal_kembali" id="tanggal_kembali" class="w-full p-2 rounded border bg-gray-100 border-gray-300 text-sm" required>
                            </div>
                            <div class="grid">
                                <label for="jumlah">Jumlah</label>
                                <div class="flex justify-between items-center border rounded bg-gray-100 border-gray-300 text-sm">
                                    <div class="border-r bg-blue-900 hover:bg-blue-950 text-white border-gray-300 px-4 py-2 rounded-l cursor-pointer" onclick="kurangJumlah()">
                                        <i class="fa-solid fa-minus"></i>
                                    </div>
                                    <input type="number" name="jumlah" id="jumlah" class="no-spinner rounded w-full bg-gray-100 p-2 focus:outline-none" value="1" min="1">
                                    <div class="border-l bg-blue-900 hover:bg-blue-950 text-white border-gray-300 px-4 py-2 rounded-r cursor-pointer" onclick="tambahJumlah()">
                                        <i class="fa-solid fa-plus"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="items-end flex w-full">
                            <button type="submit" class="rounded-full bg-blue-900 hover:bg-blue-950 w-full text-white px-3 py-2">Pinjam</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>    
</div>
<style>
    @layer utilities {
    .no-spinner::-webkit-inner-spin-button,
    .no-spinner::-webkit-outer-spin-button {
        -webkit-appearance: none !important;
        margin: 0;
    }

    .no-spinner {
        -moz-appearance: textfield !important;
    }
}
</style>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const button = document.querySelector('[pinjam-modal-target]');
        const modal = document.querySelector(button.getAttribute('pinjam-modal-target'));
        const overlay = document.getElementById('pinjamOverlay');
        const form = document.getElementById('pinjamForm');

        button.addEventListener('click', function () {
            modal.classList.remove('hidden');
            overlay.classList.remove('hidden');
        });

    });

    function kurangJumlah() {
        const jumlah = document.getElementById('jumlah');
        if (jumlah.value > 1) {
            jumlah.value = parseInt(jumlah.value) - 1;
        }
    }

    function tambahJumlah() {
        const jumlah = document.getElementById('jumlah');
        jumlah.value = parseInt(jumlah.value) + 1;
    }

    function closeFormPinjam() {
        document.getElementById('pinjamModal').classList.add('hidden');
        document.getElementById('pinjamOverlay').classList.add('hidden');
    }
</script>