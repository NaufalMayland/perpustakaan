@extends('auth.layout.layout')
@section('content')
    <div class="flex flex-col-reverse lg:flex-row bg-white p-10 gap-4 items-center lg:h-screen h-auto">
        <div class="grid w-full">
            <div class="gap-6">
                <div class="">
                    <h1 class="text-3xl lg:text-left text-center font-bold text-blue-600">MyLibrary</h1>
                </div>
                <div class="lg:text-justify text-center text-sm">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. At nemo inventore eaque dolore sit ducimus iusto ipsam doloremque ipsa nihil. Doloribus eius dolorum perferendis sunt hic voluptate harum, cupiditate in!</p>
                </div>
            </div>
            <div class="mt-6 lg:text-left text-center">
                <a href="#about" class="bg-blue-600 py-2 px-4 text-white text-sm rounded-l-full rounded-br-full rounded-tr-full shadow-none hover:rounded-tr-none hover:shadow-md hover:shadow-blue-600/50 transition-all duration-100 ease-in-out">Read more</a>
            </div>
        </div>
        <div class="w-full">
            <div class="flex items-center">
                <img src="{{ asset('storage/image/readingBook1.png') }}" alt="" class="">
            </div>
        </div>
    </div>
    <div class="bg-gray-100 p-10 h-auto w-full">
        <div class="justify-center text-center font-bold flex">
            <h1 class="text-3xl">Bagaimana cara kerja <span class="text-blue-600">MyLibrary</span> ?</h1>
        </div>
        <div class="flex lg:flex-row flex-col gap-4 items-center justify-between mt-10 w-full">
            <div class="text-center items-center w-full h-[250px] grid p-6 bg-white rounded shadow gap-4">
                <div class="">
                    <i class="fa-solid fa-globe text-blue-600 text-6xl"></i>
                </div>
                <div class="grid gap-2">
                    <h1 class="font-bold text-lg">Masuk Website MyLibrary</h1>
                    <p class="text-sm">Kamu bisa search MyLibrary atau langsung masuk tautan MyLibrary.com</p>
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
                    <p class="text-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
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
                    <p class="text-sm">Admin akan menginputkan data peminjaman dan kamu bisa ambil buku pinjamanmu</p>
                </div>
            </div>
        </div>
    </div>
    <div class="p-10 h-screen" id="about">
        <div class="flex lg:flex-row flex-col items-center">
            <div class="w-full">
                <div class="text-center">
                    <span class="text-3xl font-bold"><span class="text-blue-600">MyLibrary</span> bukan sekedar perpustakaan digital</span>
                </div>
                <div class="text-sm text-center mt-4">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Tempora deserunt iusto, corrupti ullam optio, illo laborum saepe pariatur repudiandae, placeat sequi perspiciatis commodi ducimus dolorum labore consequuntur. Cupiditate fugiat magnam molestias eos error consequatur quaerat dolore animi architecto accusamus modi, et corporis! Est quisquam consectetur ducimus totam sed voluptas modi sit animi necessitatibus distinctio debitis et, consequuntur illum explicabo, atque aliquam. Alias velit nemo iure rerum unde non odit officia.
                </div>
            </div>
        </div>
    </div>
    <div class="p-10 flex bg-[#333]">
        <div class="flex text-center justify-center items-center w-full">
            <span class="text-white font-bold text-3xl">MyLibrary</span>
        </div>
    </div>
@endsection