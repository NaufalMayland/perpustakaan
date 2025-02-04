<nav class="bg-white shadow py-4 px-6 flex justify-between items-center">
    <div class="flex items-center gap-2">
        <i class="fa-solid fa-book-open-reader text-blue-900"></i>
        <h1 class="font-bold text-lg text-blue-900">PERPUSTAKAAN</h1>
    </div>
    <div class="flex gap-6 text-sm items-center">
        <div>
            <a href="{{ route('peminjam.home.index') }}" class="hover:text-blue-950 @if (Route::is('peminjam.home.index')) text-blue-900 @endif">Home</a>
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
                <i class="fa-solid fa-chevron-down"></i>
            </button>
            <div id="profilDropdown" class="absolute right-0 mt-2 w-40 bg-white border shadow-lg rounded-lg hidden">
                <a href="#" class="block w-full text-left px-4 py-2 text-sm text-black hover:bg-gray-100">Lihat Profil</a>
                <form id="logoutForm" action="{{ route('auth.logout') }}" method="post" hidden>
                    @csrf
                </form>
                <button class="block w-full text-left px-4 py-2 text-sm text-black hover:bg-gray-100" onclick="confirmLogout()">Logout</button>
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
