<nav class="bg-white shadow py-4 px-6 flex justify-between items-center">
    <div class="flex items-center gap-2">
        <i class="fa-solid fa-book-open-reader text-blue-900"></i>
        <h1 class="font-bold text-lg text-blue-900">PERPUSTAKAAN</h1>
    </div>
    <div class="flex gap-6 text-sm items-center">
        <div class="">
            <a href="{{ route('peminjam.home.index') }}" class="hover:text-blue-900 @if (Route::is('peminjam.home.index')) text-blue-900 @endif">Home</a>
        </div>
        <div class="">
            <a href="" class="text-black hover:text-blue-900">Peminjaman</a>
        </div>
        <div class="">
            <a href="" class="text-black hover:text-blue-900">Koleksi</a>
        </div>
        <div class="">
            <a href="" class="text-black hover:text-blue-900">Profil</a>
        </div>
        <div class="items-center ">
            <form id="logoutForm" action="{{ route('auth.logout') }}" method="post">
                @csrf
            </form>
            <button type="submit" class="text-white bg-blue-900 rounded-full py-2 px-4 border border-blue-900 hover:bg-white hover:text-blue-900 transition-all duration-100 ease-in-out" onclick="confirmLogout()">Logout</button>    
        </div>
    </div>
</nav>

<script>
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