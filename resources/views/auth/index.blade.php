@extends('auth.layout.layout')
@section('content')
    <div class="flex justify-between bg-white p-10 gap-4 items-center h-screen">
        <div class="grid w-full">
            <div class="gap-4">
                <div class="">
                    <h1 class="text-2xl font-bold text-blue-600">Tentang Kami</h1>
                </div>
                <div class="text-justify text-sm">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. At nemo inventore eaque dolore sit ducimus iusto ipsam doloremque ipsa nihil. Doloribus eius dolorum perferendis sunt hic voluptate harum, cupiditate in!</p>
                </div>
            </div>
            <div class="mt-6">
                <a href="" class="bg-blue-600 py-2 px-4 text-white text-sm rounded-l-full rounded-br-full rounded-tr-full shadow-none hover:rounded-tr-none hover:shadow-md hover:shadow-blue-600/50 transition-all duration-100 ease-in-out">Read more</a>
            </div>
        </div>
        <div class="w-full">
            <div class="flex items-center justify-center">
                <img src="{{ asset('storage/image/readingBook1.png') }}" alt="" class="">
            </div>
        </div>
    </div>
    <div class="bg-gray-200 flex p-10 h-screen">
        <div class="">
        </div>
    </div>
@endsection