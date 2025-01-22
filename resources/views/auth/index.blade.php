@extends('auth.layout.layout')
@section('content')
    <div class="flex flex-col-reverse lg:flex-row bg-white p-10 gap-4 items-center lg:h-screen h-auto">
        <div class="grid w-full gap-6">
            <div class="gap-4 flex-col flex">
                <div class="">
                    <h1 class="text-3xl lg:text-left text-center font-bold text-blue-600">MyLibrary</h1>
                </div>
                <div class="lg:text-justify text-center text-base">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. At nemo inventore eaque dolore sit ducimus iusto ipsam doloremque ipsa nihil. Doloribus eius dolorum perferendis sunt hic voluptate harum, cupiditate in!</p>
                </div>
            </div>
            <div class="lg:text-left text-center">
                <a href="#about" class="bg-blue-600 py-2 px-4 text-white text-base rounded-l-full rounded-br-full rounded-tr-full shadow-none hover:rounded-tr-none hover:shadow-md hover:shadow-blue-600/50 transition-all duration-100 ease-in-out">Read more</a>
            </div>
        </div>
        <div class="w-full">
            <div class="flex items-center">
                <img src="{{ asset('storage/image/readingBook1.png') }}" alt="" class="">
            </div>
        </div>
    </div>
    <div class="bg-blue-600 p-10 h-auto w-full">
        <div class="justify-center text-center font-bold flex">
            <h1 class="text-3xl text-white">Bagaimana cara kerja MyLibrary ?</h1>
        </div>
        <div class="flex lg:flex-row flex-col gap-4 items-center justify-between mt-10 w-full">
            <div class="text-center items-center w-full h-[250px] grid p-6 bg-white rounded shadow gap-4">
                <div class="">
                    <i class="fa-solid fa-globe text-blue-600 text-6xl"></i>
                </div>
                <div class="grid gap-2">
                    <h1 class="font-bold text-lg">Masuk Website MyLibrary</h1>
                    <p class="text-base">Kamu bisa search MyLibrary atau langsung masuk tautan MyLibrary.com</p>
                </div>
            </div>
            <div class="">
                <i class="fa-solid fa-arrow-right"></i>
            </div>
            <div class="text-center items-center w-full h-[250px] grid p-6 bg-white rounded shadow gap-4">
                <div class="">
                    <i class="fa-solid fa-magnifying-glass text-blue-600 text-6xl"></i>
                </div>
                <div class="grid gap-2">
                    <h1 class="font-bold text-lg">Cari Buku</h1>
                    <p class="text-base">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                </div>
            </div>
            <div class="">
                <i class="fa-solid fa-arrow-right"></i>
            </div>
            <div class="text-center items-center w-full h-[250px] grid p-6 bg-white rounded shadow gap-4">
                <div class="">
                    <i class="fa-solid fa-book text-blue-600 text-6xl"></i>
                </div>
                <div class="grid gap-2">
                    <h1 class="font-bold text-lg">Pinjam Buku</h1>
                    <p class="text-base">Admin akan menginputkan data peminjaman dan kamu bisa ambil buku pinjamanmu</p>
                </div>
            </div>
        </div>
    </div>
    <div class="p-10 h-auto lg:h-screen flex items-center" id="about">
        <div class="flex lg:flex-row flex-col items-center gap-4">
            <div class="w-full">
                <img src="{{ asset('storage/image/perpus.png') }}" alt="" class="">
            </div>
            <div class="w-full gap-4 flex flex-col">
                <div class="text-center px-4">
                    <span class="text-3xl font-bold"><span class="text-blue-600">MyLibrary</span> bukan sekedar perpustakaan digital</span>
                </div>
                <div class="text-base text-center">
                    <p>MyLibrary adalah layanan peminjaman buku yang memudahkan kamu untuk mencari dan memesan buku secara online. Setelah memesan, kamu bisa datang langsung ke toko untuk mengambil buku pinjamanmu.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="py-10 px-20 h-auto">
        <div class="bg-blue-600 rounded shadow p-4">
            <div class="text-white font-semibold text-3xl text-center flex items-center justify-center p-10">
                <h1>MyLibrary, Makes You Eazy!</h1>
            </div>
            <div class="p-6 flex lg:flex-row flex-col justify-center lg:justify-between items-center gap-4">
                <div class="flex flex-row gap-4 items-center w-full">
                    <i class="fa-solid fa-1 text-blue-300 text-2xl text-center items-center flex "></i>
                    <span class="text-base text-white text-left border-l-2 py-2 px-4">Mempermudah akses informasi</span>
                </div>
                <div class="flex flex-row gap-4 items-center w-full">
                    <i class="fa-solid fa-2 text-blue-300 text-2xl text-center items-center flex "></i>
                    <span class="text-base text-white text-left border-l-2 py-2 px-4">Mempermudah peminjaman buku</span>
                </div>
                <div class="flex flex-row gap-4 items-center w-full">
                    <i class="fa-solid fa-3 text-blue-300 text-2xl text-center items-center flex "></i>
                    <span class="text-base text-white text-left border-l-2 py-2 px-4">Mengatasi keterbatasan ruang dan waktu</span>
                </div>
                <div class="flex flex-row gap-4 items-center w-full">
                    <i class="fa-solid fa-4 text-blue-300 text-2xl text-center items-center flex "></i>
                    <span class="text-base text-white text-left border-l-2 py-2 px-4">Bermanfaat untuk masyarakat</span>
                </div>
            </div>
        </div>
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#333" fill-opacity="1" d="M0,224L80,218.7C160,213,320,203,480,213.3C640,224,800,256,960,272C1120,288,1280,288,1360,288L1440,288L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z"></path></svg>
    <div class="p-10 flex bg-[#333]">
        <div class="flex text-center justify-center items-center w-full">
            {{-- <span class="text-white font-bold text-3xl">MyLibrary</span> --}}
        </div>
    </div>
@endsection