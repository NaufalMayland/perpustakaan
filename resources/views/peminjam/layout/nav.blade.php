<nav class="bg-white shadow py-2 px-6 flex justify-between items-center sticky top-0">
    <div class="flex items-center justify-start gap-4">
        <div class="flex items-center gap-2">
            <a href="{{ route('peminjam.index') }}" class="font-bold text-lg text-blue-900">
                <i class="fa-solid fa-book-open-reader"></i>
                <span>MyLibrary</span>
            </a>
        </div>
    </div>
    <form class="flex justify-center items-center border rounded" action="{{ route('peminjam.searchBuku') }}" method="GET">
        @csrf
        <input type="text" name="search" id="search" class="rounded px-4 py-2 focus:outline-none" value="{{ old('search') }}" placeholder="Search..." autocomplete="off">
        <button type="submit" class="bg-blue-900 hover:bg-blue-950 text-white px-4 py-2 rounded-r cursor-pointer">
            <i class="fa-solid fa-magnifying-glass text-white"></i>
        </button>
    </form>
    <div class="flex gap-6 justify-end items-center">
        <div class="relative">
            <button id="genreBtn" class="flex items-center gap-2 text-black hover:text-blue-950">
                <span>Genre</span>
                <i class="fa-solid fa-chevron-down text-xs"></i>
            </button>
            <div id="genreDropdown" class="absolute right-0 mt-2 w-96 bg-white border shadow-lg rounded hidden gap-2 px-4 py-2">
                <div class="grid grid-cols-3 gap-2">
                    @foreach ($kategori as $item)
                        <a href="{{ route('peminjam.searchByKategori', $item->id) }}" class="text-black capitalize hover:underline">{{ $item->kategori }}</a>
                    @endforeach
                </div>
            </div>
        </div>
        <div>
            <a href="" class="text-black hover:text-blue-950">Peminjaman</a>
        </div>
        <a href="{{ route('peminjam.koleksiBuku') }}" class="flex items-center w-full hover:text-blue-950 gap-1 @if(Route::is('peminjam.koleksiBuku')) text-blue-950 @endif">
            <div class="">
                <span class="">Koleksi</span>
            </div>
            @if ($countKoleksi == 0) 
                <div class="">
                    <span></span>
                </div>
            @else
                <div class="bg-blue-900 text-white rounded-full p-2 text-xs w-4 h-4 flex items-center justify-center">
                    <span>{{ $countKoleksi }}</span>
                </div>
            @endif
        </a>
        <div class="relative">
            <button id="profilBtn" class="flex items-center gap-2 text-black hover:text-blue-950">
                <span class="">Profil</span>
                <i class="fa-solid fa-chevron-down text-xs"></i>
            </button>
            <div id="profilDropdown" class="absolute right-0 mt-2 w-40 bg-white border shadow-lg rounded hidden">
                <a href="{{ route('peminjam.profil') }}" class="block w-full text-left px-4 py-2 text-black hover:text-blue-950 hover:bg-gray-100">Profil</a>
                <form id="logoutForm" action="{{ route('auth.logout') }}" method="POST" hidden>
                    @csrf
                </form>
                <button class="block w-full text-left px-4 py-2 text-black hover:text-blue-900 hover:bg-gray-100" onclick="confirmLogout()">Logout</button>
            </div>
        </div>
    </div>
</nav>

<script>
    function setupDropdown(buttonId, dropdownId) {
        const button = document.getElementById(buttonId);
        const dropdown = document.getElementById(dropdownId);

        button.addEventListener('click', function (event) {
            event.stopPropagation();
            dropdown.classList.toggle('hidden');
        });

        window.addEventListener('click', function (event) {
            if (!button.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });
    }

    setupDropdown('profilBtn', 'profilDropdown');
    setupDropdown('genreBtn', 'genreDropdown');

    function confirmLogout() {
        Swal.fire({
            title: 'Logout',
            text: "Anda yakin untuk logout?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#2563eb',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logoutForm').submit();
            }
        });
    }
</script>
