<div class="relative w-80 h-screen">
    <div class="bg-white shadow-md w-64 h-screen fixed ">
        <div class="flex gap-2 text-center text-blue-900 items-center justify-center p-8 font-bold text-lg">
            <i class="fa-solid fa-book-open-reader"></i>
            <h1>PERPUSTAKAAN</h1>
        </div>
        <nav class="text-sm">
            <ul>
                <li>
                    <a href="{{route('petugas.dashboard.index')}}" class="py-3 pl-5 space-x-2 flex items-center border-0 hover:bg-gray-100 hover:border-l-4 hover:border-blue-900 transition-all duration-100 ease-in-out @if(Route::is('petugas.dashboard.*')) bg-gray-100 border-blue-900 border-l-4 @endif">
                        {{-- <i class="fa-solid fa-house text-blue-900 text-lg"></i> --}}
                        <span>Dashboard</span>
                    </a>
                </li>
                @if ($sesPetugas->role == 'admin')                    
                    <li>
                        <a href="{{route('petugas.buku.index')}}" class="py-3 pl-5 space-x-2 flex items-center border-0 hover:bg-gray-100 hover:border-l-4 hover:border-blue-900 transition-all duration-100 ease-in-out  @if(Route::is('petugas.buku.*')) bg-gray-100 border-blue-900 border-l-4 @endif">
                            {{-- <i class="fa-solid fa-gear text-blue-900 text-lg"></i> --}}
                            <span>Buku</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('petugas.kategori.index')}}" class="py-3 pl-5 space-x-2 flex items-center border-0 hover:bg-gray-100 hover:border-l-4 hover:border-blue-900 transition-all duration-100 ease-in-out  @if(Route::is('petugas.kategori.*')) bg-gray-100 border-blue-900 border-l-4 @endif">
                            {{-- <i class="fa-solid fa-gear text-blue-900 text-lg"></i> --}}
                            <span>Kategori</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('petugas.listKategori.index')}}" class="py-3 pl-5 space-x-2 flex items-center border-0 hover:bg-gray-100 hover:border-l-4 hover:border-blue-900 transition-all duration-100 ease-in-out  @if(Route::is('petugas.listKategori.*')) bg-gray-100 border-blue-900 border-l-4 @endif">
                            {{-- <i class="fa-solid fa-gear text-blue-900 text-lg"></i> --}}
                            <span>List Kategori</span>
                        </a>
                    </li>
                @elseif ($sesPetugas->role == 'petugas')                    
                <li>
                    <a href="{{route('petugas.user.index')}}" class="py-3 pl-5 space-x-2 flex items-center border-0 hover:bg-gray-100 hover:border-l-4 hover:border-blue-900 transition-all duration-100 ease-in-out  @if(Route::is('petugas.user.*')) bg-gray-100 border-blue-900 border-l-4 @endif">
                        {{-- <i class="fa-solid fa-gear text-blue-900 text-lg"></i> --}}
                        <span>User</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('petugas.peminjaman.index')}}" class="py-3 pl-5 space-x-2 flex items-center border-0 hover:bg-gray-100 hover:border-l-4 hover:border-blue-900 transition-all duration-100 ease-in-out  @if(Route::is('petugas.peminjaman.*')) bg-gray-100 border-blue-900 border-l-4 @endif">
                        {{-- <i class="fa-solid fa-gear text-blue-900 text-lg"></i> --}}
                        <span>Peminjaman</span>
                    </a>
                </li>
                <li>
                    <a href="" class="py-3 pl-5 space-x-2 flex items-center border-0 hover:bg-gray-100 hover:border-l-4 hover:border-blue-900 transition-all duration-100 ease-in-out  @if(Route::is('petugas.denda.*')) bg-gray-100 border-blue-900 border-l-4 @endif">
                        {{-- <i class="fa-solid fa-gear text-blue-900 text-lg"></i> --}}
                        <span>Denda</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('petugas.ulasan.index')}}" class="py-3 pl-5 space-x-2 flex items-center border-0 hover:bg-gray-100 hover:border-l-4 hover:border-blue-900 transition-all duration-100 ease-in-out  @if(Route::is('petugas.ulasan.*')) bg-gray-100 border-blue-900 border-l-4 @endif">
                        {{-- <i class="fa-solid fa-gear text-blue-900 text-lg"></i> --}}
                        <span>Ulasan</span>
                    </a>
                </li>
                @endif
            </ul>
        </nav>
        <div class="justify-center items-center text-center p-6">
            <form id="logoutForm" action="{{route('auth.logout')}}" method="post">
                @csrf
            </form>
            <button type="submit" class="py-2 px-5 text-sm text-white rounded-full bg-blue-900  hover:bg-white hover:text-blue-900 border-0 hover:border hover:border-blue-900 transition-all duration-100 ease-in-out" onclick="confirmLogout()">logout</button>
        </div>
    </div>
</div>
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

    // document.querySelectorAll('[data-collapse-toggle]').forEach(button => {
    //     button.addEventListener('click', () => {
    //         const targetId = button.getAttribute('aria-controls');
    //         const target = document.getElementById(targetId);
    //         const parentDropdown = button.closest('.dropdown'); 
    //         const currentRoute = "{{ Route::currentRouteName() }}";

    //         document.querySelectorAll('.dropdown').forEach(dropdown => {
    //             if (currentRoute !== 'user.dataPetugas.index' && currentRoute !== 'user.dataPeminjam.index') {
    //                 dropdown.classList.remove('border-blue-900', 'border-l-4');
    //                 const dropdownButton = dropdown.querySelector('button');
    //                 if (dropdownButton) {
    //                     dropdownButton.classList.remove('bg-gray-100', 'text-black');
    //                 }
    //             }
    //         });

    //         if (target) {
    //             target.classList.toggle('hidden');
    //             button.setAttribute('aria-expanded', !target.classList.contains('hidden'));

    //             if (!target.classList.contains('hidden')) {
    //                 parentDropdown.classList.add('border-blue-900', 'border-l-4');
    //                 button.classList.add('bg-gray-100', 'text-black');
    //             } else {
    //                 if (currentRoute !== 'user.dataPetugas.index' && currentRoute !== 'user.dataPeminjam.index') {
    //                     parentDropdown.classList.remove('bg-gray-100', 'border-blue-900', 'border-l-4');
    //                 }
    //             }
    //         } else {
    //             console.error(`Element with ID ${targetId} not found`);
    //         }
    //     });
    // });
</script>