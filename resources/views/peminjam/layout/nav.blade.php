<nav class="bg-white shadow py-2 px-6 flex items-center justify-between sticky top-0">
    <div class="flex items-center gap-4">
        <a href="{{ route('peminjam.index') }}" class="font-bold text-lg text-blue-900 flex items-center gap-2">
            <i class="fa-solid fa-book-open-reader"></i>
            <span>MyLibrary</span>
        </a>
    </div>
    <div class="hidden md:flex flex-1 justify-center">
        <form class="flex items-center border rounded-full" action="{{ route('peminjam.searchBuku') }}" method="GET">
            @csrf
            <input type="text" name="search" id="search" class="rounded-full px-4 py-2 focus:outline-none" value="{{ old('search') }}" placeholder="Search..." autocomplete="off">
            <button type="submit" class="bg-blue-900 hover:bg-blue-950 text-white px-4 py-2 rounded-r-full cursor-pointer">
                <i class="fa-solid fa-magnifying-glass text-white"></i>
            </button>
        </form>
    </div>
    <button id="mobileMenuBtn" class="md:hidden text-blue-900">
        <i class="fa-solid fa-bars"></i>
    </button>
    <div id="mobileMenu" class="hidden md:flex flex-col md:flex-row gap-6 justify-end items-center md:relative absolute top-full left-0 w-full md:w-auto bg-white md:bg-transparent shadow md:shadow-none p-4 md:p-0">
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
        <div class="">
            <a href="{{ route('peminjam.peminjamanBuku') }}" class="hover:text-blue-950 @if(Route::is('peminjam.peminjamanBuku')) text-blue-950 @endif">Peminjaman</a>
        </div>
        <div class="">
            <a href="{{ route('peminjam.koleksiBuku') }}" class="hover:text-blue-950 @if(Route::is('peminjam.koleksiBuku')) text-blue-950 @endif">Koleksi</a>
        </div>
        <div class="relative">
            <button id="profilBtn" class="flex items-center gap-2 text-black hover:text-blue-950">
                <img src="{{ $peminjam->foto ? asset('storage/' . $peminjam->foto) : 'https://i.pinimg.com/736x/29/b8/d2/29b8d250380266eb04be05fe21ef19a7.jpg' }}" alt="{{ $peminjam->nama }}" class="rounded-full w-10 object-cover hidden md:block">
                <span class="block md:hidden">Profil</span>
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
    document.getElementById('mobileMenuBtn').addEventListener('click', function () {
        document.getElementById('mobileMenu').classList.toggle('hidden');
    });

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
            confirmButtonColor: '#1E3A8A',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logoutForm').submit();
            }
        });
    }
</script>
