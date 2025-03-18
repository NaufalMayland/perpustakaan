@extends('auth.layout.layout')
@section('content')
    <div class="flex justify-between flex-col-reverse lg:flex-row bg-white px-14 py-4 gap-4 items-center lg:h-screen h-auto" id="about">
        <div class="grid w-full">
            <div class="mb-6">
                <h1 class="text-3xl lg:text-left text-center font-bold text-blue-900">MyLibrary</h1>
            </div>
            <div class="lg:text-left text-center text-base" data-aos="fade-up" data-aos-anchor-placement="center-bottom" data-aos-duration="900">
                <p>Selamat datang di MyLibrary, tempat di mana pengetahuan dan imajinasi bertemu. Kami menyediakan berbagai koleksi buku berkualitas untuk memenuhi kebutuhan bacaan Anda. Temukan buku favorit Anda, pinjam dengan mudah, dan nikmati pengalaman membaca tanpa batas. Mari jelajahi dunia literasi bersama kami!</p>
            </div>
            <div class="lg:text-left text-center mt-4" data-aos="fade-up" data-aos-anchor-placement="center-bottom" data-aos-duration="900">
                <a href="#readmore" class="bg-blue-900 py-2 px-4 text-white text-base rounded-l-full rounded-br-full rounded-tr-full shadow-none hover:rounded-tr-none hover:shadow hover:shadow-blue-900/50 transition-all duration-100 ease-in-out">Read more</a>
            </div>
        </div>
        <div class="w-full">
            <div class="flex justify-center items-center w-full">
                <img src="https://img.freepik.com/free-vector/people-library-flat-vector-illustration_74855-6607.jpg?t=st=1740754720~exp=1740758320~hmac=8b7240c937784e0ad618c2441dbc454e083ab6286120de8c78345459ceeaf394&w=1480" alt="" class="lg:w-[70%] w-[50%]">
            </div>
        </div>
    </div>
    <div class="bg-blue-900 px-14 py-4 h-auto w-full mt-4">
        <div class="justify-center text-center font-bold flex px-10 pt-10">
            <h1 class="text-3xl text-white">Bagaimana cara kerja MyLibrary ?</h1>
        </div>
        <div class="flex lg:flex-row flex-col gap-4 items-center justify-between mt-10 w-full p-6">
            <div class="text-center items-center w-full h-[250px] grid p-6 bg-white rounded shadow gap-4" data-aos="fade-up" data-aos-anchor-placement="center-bottom" data-aos-duration="900">
                <div class="">
                    <i class="fa-solid fa-globe text-blue-900 text-6xl"></i>
                </div>
                <div class="grid gap-4">
                    <h1 class="font-bold text-lg">Masuk Website MyLibrary</h1>
                    <p class="text-base">Kamu bisa search MyLibrary atau langsung masuk tautan MyLibrary.com</p>
                </div>
            </div>
            <div class="" data-aos="fade-up" data-aos-anchor-placement="center-bottom" data-aos-duration="900">
                <i class="fa-solid fa-arrow-right text-white text-lg"></i>
            </div>
            <div class="text-center items-center w-full h-[250px] grid p-6 bg-white rounded shadow gap-4" data-aos="fade-up" data-aos-anchor-placement="center-bottom" data-aos-duration="900">
                <div class="">
                    <i class="fa-solid fa-magnifying-glass text-blue-900 text-6xl"></i>
                </div>
                <div class="grid gap-2">
                    <h1 class="font-bold text-lg">Cari Buku</h1>
                    <p class="text-base">Cari buku yang ingin kamu pinjam</p>
                </div>
            </div>
            <div class="" data-aos="fade-up" data-aos-anchor-placement="center-bottom" data-aos-duration="900">
                <i class="fa-solid fa-arrow-right text-white text-lg"></i>
            </div>
            <div class="text-center items-center w-full h-[250px] grid p-6 bg-white rounded shadow gap-4" data-aos="fade-up" data-aos-anchor-placement="center-bottom" data-aos-duration="900">
                <div class="">
                    <i class="fa-solid fa-book text-blue-900 text-6xl"></i>
                </div>
                <div class="grid gap-2">
                    <h1 class="font-bold text-lg">Pinjam Buku</h1>
                    <p class="text-base">Petugas akan menginputkan data peminjaman dan kamu bisa ambil buku pinjamanmu</p>
                </div>
            </div>
        </div>
    </div>
    <div class="px-14 py-4 h-auto lg:h-screen flex items-center" id="readmore">
        <div class="flex lg:flex-row flex-col items-center gap-4">
            <div class="w-full justify-center flex">
                <img src="https://img.freepik.com/free-vector/people-library-flat-vector-illustration_74855-6607.jpg?t=st=1740754720~exp=1740758320~hmac=8b7240c937784e0ad618c2441dbc454e083ab6286120de8c78345459ceeaf394&w=1480" alt="" class="lg:w-[70%] w-[50%]">
            </div>
            <div class="w-full gap-4 flex flex-col">
                <div class="text-center px-4">
                    <span class="text-3xl font-bold"><span class="text-blue-900">MyLibrary</span> bukan sekedar perpustakaan digital</span>
                </div>
                <div class="text-base text-center" data-aos="fade-up" data-aos-anchor-placement="center-bottom" data-aos-duration="850">
                    <p>MyLibrary adalah layanan peminjaman buku yang memudahkan kamu untuk mencari dan melaukan peminjaman buku secara online. Setelah melakukan peminjaman, petugas akan mengonfirmasi peminjamanmu dan kamu bisa datang langsung ke toko untuk mengambil buku pinjamanmu.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="px-14 h-auto" id="keunggulan">
        <div class="bg-blue-900 rounded shadow p-4 border" data-aos="fade-up" data-aos-anchor-placement="center-bottom" data-aos-duration="900">
            <div class="text-white font-semibold text-3xl text-center flex items-center justify-center p-10">
                <h1>MyLibrary, Makes You Eazy!</h1>
            </div>
            <div class="p-6 flex lg:flex-row flex-col justify-center w-full lg:justify-between items-center gap-4">
                <div class="flex flex-row gap-4 items-center w-full" data-aos="fade-up" data-aos-anchor-placement="center-bottom" data-aos-duration="900">
                    <i class="fa-solid fa-1 text-blue-300 text-2xl text-center items-center flex"></i>
                    <span class="text-base text-white text-left border-l-2 py-2 px-4">Mempermudah akses informasi</span>
                </div>
                <div class="flex flex-row gap-4 items-center w-full" data-aos="fade-up" data-aos-anchor-placement="center-bottom" data-aos-duration="900">
                    <i class="fa-solid fa-2 text-blue-300 text-2xl text-center items-center flex"></i>
                    <span class="text-base text-white text-left border-l-2 py-2 px-4">Mempermudah peminjaman buku</span>
                </div>
                <div class="flex flex-row gap-4 items-center w-full" data-aos="fade-up" data-aos-anchor-placement="center-bottom" data-aos-duration="900">
                    <i class="fa-solid fa-3 text-blue-300 text-2xl text-center items-center flex"></i>
                    <span class="text-base text-white text-left border-l-2 py-2 px-4">Mengatasi keterbatasan ruang dan waktu</span>
                </div>
                <div class="flex flex-row gap-4 items-center w-full" data-aos="fade-up" data-aos-anchor-placement="center-bottom" data-aos-duration="900">
                    <i class="fa-solid fa-4 text-blue-300 text-2xl text-center items-center flex"></i>
                    <span class="text-base text-white text-left border-l-2 py-2 px-4">Bermanfaat untuk masyarakat</span>
                </div>
            </div>
        </div>
    </div>
    <div class="flex text-center justify-center items-center mt-10">
        <div class="flex items-center">
            <a href="{{ route('peminjam.index') }}" class="bg-white py-2 px-6 rounded-full border border-blue-900 flex gap-2 items-center hover:bg-blue-900 hover:text-white transition-all duration-100 ease-in-out" data-aos="fade-up" data-aos-anchor-placement="center-bottom" data-aos-duration="900">
                <span class="">Coba sekarang</span>
                <i class="fa-solid fa-arrow-right text-lg "></i>
            </a>
        </div>
    </div>

    <script>
        AOS.init();
    </script>
@endsection