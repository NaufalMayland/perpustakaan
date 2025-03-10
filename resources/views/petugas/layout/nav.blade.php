<div class="bg-white shadow-lg w-auto h-screen sticky top-0 left-0 flex flex-col">
    <div class="flex items-center justify-center gap-2 p-6">
        <a href="{{ route('petugas.profil.index') }}" class="flex">
            @if ($sesPetugas->foto == null) 
                <img src="https://i.pinimg.com/736x/29/b8/d2/29b8d250380266eb04be05fe21ef19a7.jpg" alt="Profil" class="w-20 rounded-full">
            @else 
                <img src="{{ asset('storage/' . $sesPetugas->foto ) }}" alt="Profil" class="w-20 rounded-full object-cover">
            @endif
        </a>
        <div class="flex flex-col">
            <h2 class="text-blue-900 font-bold text-sm">{{ $sesPetugas->nama }}</h2>
            <p class="text-xs text-gray-500">{{ $sesPetugas->email }}</p>
        </div>
    </div>
    <hr class="mb-2 border-neutral-300 mx-4">
    <nav class="text-sm flex flex-col">
        <ul>
            <li>
                <a href="{{ route('petugas.dashboard.index') }}" class="py-3 pl-5 space-x-3 flex items-center hover:bg-blue-50 hover:border-l-4 hover:border-blue-900 transition-all duration-150 ease-in-out @if(Route::is('petugas.dashboard.*')) bg-blue-50 border-blue-900 border-l-4 @endif">
                    <i class="fa-solid text-blue-900 fa-house"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            @if ($sesPetugas->role == 'admin')                    
                <li>
                    <a href="{{ route('petugas.user.dpetugas.index') }}" class="py-3 pl-5 space-x-3 flex items-center hover:bg-blue-50 hover:border-l-4 hover:border-blue-900 transition-all duration-150 ease-in-out @if(Route::is('petugas.user.dpetugas*')) bg-blue-50 border-blue-900 border-l-4 @endif">
                        <i class="fa-solid text-blue-900 fa-user-shield"></i>
                        <span>Petugas</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('petugas.buku.index') }}" class="py-3 pl-5 space-x-3 flex items-center hover:bg-blue-50 hover:border-l-4 hover:border-blue-900 transition-all duration-150 ease-in-out @if(Route::is('petugas.buku.*')) bg-blue-50 border-blue-900 border-l-4 @endif">
                        <i class="fa-solid text-blue-900 fa-book"></i>
                        <span>Buku</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('petugas.kategori.index') }}" class="py-3 pl-5 space-x-3 flex items-center hover:bg-blue-50 hover:border-l-4 hover:border-blue-900 transition-all duration-150 ease-in-out @if(Route::is('petugas.kategori.*')) bg-blue-50 border-blue-900 border-l-4 @endif">
                        <i class="fa-solid text-blue-900 fa-tags"></i>
                        <span>Kategori</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('petugas.listKategori.index') }}" class="py-3 pl-5 space-x-3 flex items-center hover:bg-blue-50 hover:border-l-4 hover:border-blue-900 transition-all duration-150 ease-in-out @if(Route::is('petugas.listKategori.*')) bg-blue-50 border-blue-900 border-l-4 @endif">
                        <i class="fa-solid text-blue-900 fa-list"></i>
                        <span>List Kategori</span>
                    </a>
                </li>
            @elseif ($sesPetugas->role == 'petugas')                    
                <li>
                    <a href="{{ route('petugas.user.dpeminjam.index') }}" class="py-3 pl-5 space-x-3 flex items-center hover:bg-blue-50 hover:border-l-4 hover:border-blue-900 transition-all duration-150 ease-in-out @if(Route::is('petugas.user.dpeminjam.*')) bg-blue-50 border-blue-900 border-l-4 @endif">
                        <i class="fa-solid text-blue-900 fa-users"></i>
                        <span>Peminjam</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('petugas.peminjaman.index') }}" class="py-3 pl-5 space-x-3 flex items-center hover:bg-blue-50 hover:border-l-4 hover:border-blue-900 transition-all duration-150 ease-in-out @if(Route::is('petugas.peminjaman.*')) bg-blue-50 border-blue-900 border-l-4 @endif">
                        <i class="fa-solid text-blue-900 fa-handshake"></i>
                        <span>Peminjaman</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('petugas.denda.index') }}" class="py-3 pl-5 space-x-3 flex items-center hover:bg-blue-50 hover:border-l-4 hover:border-blue-900 transition-all duration-150 ease-in-out @if(Route::is('petugas.denda.*')) bg-blue-50 border-blue-900 border-l-4 @endif">
                        <i class="fa-solid text-blue-900 fa-money-bill-wave"></i>
                        <span>Denda</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('petugas.ulasan.index') }}" class="py-3 pl-5 space-x-3 flex items-center hover:bg-blue-50 hover:border-l-4 hover:border-blue-900 transition-all duration-150 ease-in-out @if(Route::is('petugas.ulasan.*')) bg-blue-50 border-blue-900 border-l-4 @endif">
                        <i class="fa-solid text-blue-900 fa-comments"></i>
                        <span>Ulasan</span>
                    </a>
                </li>
            @endif
        </ul>
    </nav>
    <hr class="my-2 border-neutral-300 mx-4">
    <div class="text-center p-6">
        <form id="logoutForm" action="{{ route('auth.logout') }}" method="post">
            @csrf
        </form>
        <button type="submit" class="py-2 px-5 text-sm text-white rounded-full bg-blue-900 hover:bg-blue-950 transition-all duration-150 ease-in-out" onclick="confirmLogout()">
            <i class="fa-solid fa-right-from-bracket"></i>
            Logout
        </button>
    </div>
</div>
<script>
    function confirmLogout() {
        Swal.fire({
            title: 'Logout',
            text: 'Anda yakin untuk logout?',
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
