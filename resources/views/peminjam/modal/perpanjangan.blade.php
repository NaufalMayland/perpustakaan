<button perpanjangan-modal-target="#perpanjanganModal" class="flex gap-1 lg:text-base text-sm cursor-pointer w-full rounded-full p-2 text-white bg-blue-900 hover:bg-blue-950 items-center justify-center transition-all ease-in-out">
    <i class="fa-solid fa-calendar-plus"></i>
    <span>Perpanjang</span>
</button>

<div id="perpanjanganOverlay" class="fixed inset-0 bg-black bg-opacity-25 hidden min-h-screen z-30"></div>

<div class="z-40 inset-0 hidden fixed " id="perpanjanganModal">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white flex flex-col-reverse lg:flex-row rounded w-80">
            <form id="perpanjanganForm" action="{{ route('peminjaman.requestPerpanjangan', $peminjaman->id) }}" method="POST" enctype="multipart/form-data" class="w-full items-center grid gap-4 p-4">
                @csrf
                @method('PUT')
                <div class="flex flex-col justify-between gap-4 text-sm lg:text-base w-full">
                    <div class="flex justify-start lg:justify-between items-start">
                        <div class="">
                            <div class="flex">
                                <span>Ajukan Perpanjangan</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <label>
                                    <input type="radio" name="perpanjangan" id="perpanjangan" value="3"> 3 Hari
                                </label>
                            </div>
                            <div class="flex items-center gap-1">
                                <label>
                                    <input type="radio" name="perpanjangan" id="perpanjangan" value="5"> 5 Hari
                                </label>
                            </div>
                        </div>
                        <div class="justify-end items-start hidden lg:flex">
                            <a class="fa-solid fa-xmark text-neutral-500 cursor-pointer text-sm" onclick="closeFormPerpanjangan()"></a>
                        </div>
                    </div>
                    <div class="flex text-neutral-500 text-xs lg:text-sm">
                        <span>*Hanya bisa dilakukan 1 kali</span>
                    </div>
                    <div class="items-end flex w-full">
                        <button type="submit" class="rounded-full bg-blue-900 hover:bg-blue-950 w-full text-white px-3 py-2">Ajukan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>    
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const button = document.querySelector('[perpanjangan-modal-target]');
        const modal = document.querySelector(button.getAttribute('perpanjangan-modal-target'));
        const overlay = document.getElementById('perpanjanganOverlay');
        const form = document.getElementById('perpanjanganForm');

        button.addEventListener('click', function () {
            modal.classList.remove('hidden');
            overlay.classList.remove('hidden');
        });

    });

    function closeFormPerpanjangan() {
        document.getElementById('perpanjanganModal').classList.add('hidden');
        document.getElementById('perpanjanganOverlay').classList.add('hidden');
    }
</script>