<nav class="bg-white shadow py-4 px-6 flex justify-between items-center fixed z-[999] w-full">
    <div class="flex items-center gap-2">
        <i class="fa-solid fa-book-open-reader text-blue-900"></i>
        <h1 class="font-bold text-lg text-blue-900">PERPUSTAKAAN</h1>
    </div>
    <div class="flex gap-6 text-sm items-center">
        <div class="">
            <a href="#" class="hover:text-blue-900">Tentang Kami</a>
        </div>
        <div class="">
            <a href="{{ route('auth.login') }}" class="text-white bg-blue-900 rounded-full py-2 px-4 border border-blue-900 hover:bg-white hover:text-blue-900 transition-all duration-100 ease-in-out">Sign in</a>
        </div>
    </div>
</nav>