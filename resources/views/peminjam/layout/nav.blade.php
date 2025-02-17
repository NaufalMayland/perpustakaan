<nav class="bg-white shadow py-2 px-6 flex justify-between items-center sticky top-0">
    <div class="flex items-center justify-start gap-4">
        <div class="flex items-center gap-2">
            <i class="fa-solid fa-book-open-reader text-blue-900"></i>
            <h1 class="font-bold text-lg text-blue-900">PERPUSTAKAAN</h1>
        </div>
    </div>
    <form class="flex justify-center items-center border rounded" action="{{ route('peminjam.searchBuku') }}" method="GET">
        @csrf
        <div class="">
            <input type="text" name="search" id="search" class="rounded px-4 py-2 focus:outline-none" value="{{ old('search') }}" placeholder="Search..." autocomplete="off">
        </div>
        <div class="">
            <button type="submit" class="bg-blue-900 hover:bg-blue-950 text-white px-4 py-2 rounded-r cursor-pointer">
                <i class="fa-solid fa-magnifying-glass text-white"></i>
            </button>
        </div>
    </form>
    <div class="flex gap-6 justify-end items-center">
        <div class="flex items-center  gap-2">
            <a href="#" class="">Genre</a>
            <i class="fa-solid fa-chevron-down text-xs"></i>
        </div>
        <div>
            <a href="" class="text-black hover:text-blue-950">Peminjaman</a>
        </div>
        <div>
            <a href="" class="text-black hover:text-blue-950">Koleksi</a>
        </div>
        <div class="relative">
            <button id="profilBtn" class="flex items-center gap-2 text-black hover:text-blue-950">
                <span>Profil</span>
                <i class="fa-solid fa-chevron-down text-xs"></i>
            </button>
            <div id="profilDropdown" class="absolute right-0 mt-2 w-40 bg-white border shadow-lg rounded-lg hidden">
                <a href="{{ route('peminjam.profil') }}" class="block w-full text-left px-4 py-2  text-black hover:bg-gray-100">Profil</a>
                <form id="logoutForm" action="{{ route('auth.logout') }}" method="post" hidden>
                    @csrf
                </form>
                <button class="block w-full text-left px-4 py-2 text-black hover:bg-gray-100" onclick="confirmLogout()">Logout</button>
            </div>
        </div>
    </div>
</nav>

<script>
    const profilBtn = document.getElementById('profilBtn');
    const profilDropdown = document.getElementById('profilDropdown');

    profilBtn.addEventListener('click', function () {
        profilDropdown.classList.toggle('hidden');
    });

    window.addEventListener('click', function (event) {
        if (!profilBtn.contains(event.target)) {
            profilDropdown.classList.add('hidden');
        }
    });

    function confirmLogout() {
        Swal.fire({
        title: 'Logout',
        text: "Anda yakin untuk logout?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#2563eb',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
        })
        .then((result) => {
            if (result.isConfirmed) {
            document.getElementById('logoutForm').submit();
            }
        });
    }
</script>
