<nav class="bg-white shadow py-4 px-6 flex justify-between items-center">
    <div class="">
        <h1 class="font-bold text-lg text-blue-600">PERPUSTAKAAN</h1>
    </div>
    <div class="flex gap-6 text-sm items-center">
        <div class="">
            <a href="" class="text-black">Peminjaman</a>
        </div>
        <div class="">
            <a href="" class="text-black">Koleksi</a>
        </div>
        <div class="">
            <a href="" class="text-black">Profil</a>
        </div>
        <div class="items-center ">
            @if ($user == true)
                <form id="logoutForm" action="{{ route('auth.logout') }}" method="post">
                    @csrf
                </form>
                <button type="submit" class="text-white bg-blue-600 rounded-full py-2 px-4 border border-blue-600 hover:bg-white hover:text-blue-600 transition-all duration-100 ease-in-out" onclick="confirmLogout()">Sign in</button>    
            @else
                <a href="{{ route('auth.login') }}" class="text-white bg-blue-600 rounded-full py-2 px-4 border border-blue-600 hover:bg-white hover:text-blue-600 transition-all duration-100 ease-in-out">Login</a>  
            @endif
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