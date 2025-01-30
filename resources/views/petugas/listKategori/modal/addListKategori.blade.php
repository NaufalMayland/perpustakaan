<button input-modal-target="#addListKategori" class="p-2 w-full justify-center rounded bg-blue-900 flex gap-1 items-center hover:bg-blue-900 cursor-pointer">
    <i class="fa-solid fa-plus"></i>
    <span>Tambah</span>
</button>
<div id="overlayAdd" class="fixed inset-0 bg-black bg-opacity-25 hidden min-h-screen"></div>

<div class="z-50 inset-0 hidden fixed " id="addListKategori">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white rounded w-auto">
            <div class="justify-end flex p-2">
                <button class="text-black hover:bg-gray-200 rounded-full py-1 px-2 font-semibold" onclick="closeModalAdd()">✕</button>
            </div>
            <form id="addForm" action="{{ route('petugas.kategori.addListKategoriAction') }}" method="POST" enctype="multipart/form-data" class="items-center grid gap-4 px-4 pb-4">
                @csrf
                <div class="grid gap-2">
                    <div class="grid w-full text-black text-sm">
                        <label for="kategori">Buku</label>
                        <select name="buku" id="buku" class="w-80 p-2 rounded border bg-gray-100 border-gray-300 text-sm">
                            <option value="" disabled selected hidden>Pilih buku</option>
                            @foreach ($dataBuku as $data)
                                <option value="{{ $data->id }}">{{ $data->judul }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="grid gap-2">
                    <div class="grid w-full text-black text-sm">
                        <label for="kategori">Kategori</label>
                        <select name="kategori" id="kategori" class="w-80 p-2 rounded border bg-gray-100 border-gray-300 text-sm">
                            <option value="" disabled selected hidden>Pilih kategori</option>
                            @foreach ($dataKategori as $data)
                                <option value="{{ $data->id }}">{{ $data->kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="flex items-center">
                    <button type="submit" class="bg-blue-900 w-full p-2 rounded text-sm">Tambah</button>
                </div>
            </form>
        </div>
    </div>    
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const button = document.querySelector('[input-modal-target]');
        const modal = document.querySelector(button.getAttribute('input-modal-target'));
        const overlay = document.getElementById('overlayAdd');
        const form = document.getElementById('addForm');

        button.addEventListener('click', function () {
            modal.classList.remove('hidden');
            overlay.classList.remove('hidden');
        });

    });

    function closeModalAdd() {
        document.getElementById('addListKategori').classList.add('hidden');
        document.getElementById('overlayAdd').classList.add('hidden');
    }
</script>