@extends('petugas.layout.layout')
@section('content')
    <div class="bg-white rounded shadow p-4 flex flex-col lg:flex-row gap-8 items-start">
        <div class="w-full lg:w-1/4 flex justify-center">
            @if ($petugas->foto == null) 
                <img src="https://i.pinimg.com/736x/29/b8/d2/29b8d250380266eb04be05fe21ef19a7.jpg" alt="{{ $petugas->nama }}" class="size-52 rounded-full object-cover">
            @else
                <img src="{{ asset('storage/' . $petugas->foto ) }}" alt="{{ $petugas->nama }}" class="size-52 rounded-full object-cover">
            @endif
        </div>
        <div class="w-full lg:w-3/4 flex flex-col gap-4  lg:text-base">
            @if ($errors->any())
                <div class="text-white bg-red-500 text-sm py-3 px-3 rounded text-left w-full">
                    <ul>
                        @foreach ($errors->all() as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="grid">
                <label for="nama" class="text-sm">Nama</label>
                <input type="text" name="nama" id="nama" class="w-full p-2 text-sm rounded border bg-gray-100 border-gray-300 focus:outline-none" value="{{ $petugas->nama }}" readonly>
            </div>
            <div class="grid">
                <label for="email" class="text-sm">Email</label>
                <input type="text" name="email" id="email" class="w-full p-2 text-sm rounded border bg-gray-100 border-gray-300 focus:outline-none" value="{{ $petugas->email }}" readonly>
            </div>
            <div class="grid">
                <label for="alamat" class="text-sm">Alamat</label>
                <input type="text" name="alamat" id="alamat" class="w-full p-2 text-sm rounded border capitalize bg-gray-100 border-gray-300 focus:outline-none" value="@if ($petugas->alamat == !null ){{ $petugas->alamat['kelurahan']['name'] }}, {{ $petugas->alamat['kecamatan']['name'] }}, {{ $petugas->alamat['kabupaten']['name'] }}, {{ $petugas->alamat['provinsi']['name'] }}@else - @endif" readonly>
            </div>
            <div class="grid">
                <label for="telepon" class="text-sm">Telepon</label>
                <input type="text" name="telepon" id="telepon" min="1800" max="2100" class="w-full p-2 text-sm rounded border bg-gray-100 border-gray-300 focus:outline-none" value="{{ $petugas->telepon ?? "-"}}" readonly>
            </div>
            
            <div class="justify-end flex w-full items-center">
                {{-- <div class="flex flex-row mt-2 gap-4 items-center text-sm">
                    <a href="{{ url()->previous() }}" class="bg-blue-900 hover:bg-blue-950 text-white flex w-full items-center gap-2 py-2 px-4 rounded">
                        <i class="fa-solid fa-arrow-left text-sm"></i>
                        <span>Kembali</span>
                    </a>
                </div> --}}
                <div class="flex flex-row mt-2 gap-4 items-center text-sm">
                    <a href="{{ route('petugas.profil.editProfil', $petugas->id) }}" class="bg-blue-900 hover:bg-blue-950 text-white flex w-full items-center gap-2 py-2 px-4 rounded-full">
                        <i class="fa-solid fa-pencil text-sm"></i>
                        <span class="text-sm">Edit</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('petugas.ubahPasswordPetugas', $petugas->id) }}" method="POST" class="bg-white rounded shadow p-4 mt-4 gap-4 text-sm grid">
        @csrf
        @if (session('errors'))
            <div class="text-white bg-red-500 text-sm p-3 rounded text-left w-full">
                <ul>
                    <li>{{ session('errors') }}</li>
                </ul>
            </div>
        @endif
        <div class="grid relative">
            <label class="text-black" for="password">Password Baru</label>
            <input class="w-full p-2 rounded border bg-gray-100 border-gray-300 focus:outline-none" type="password" name="password" id="password" autocomplete="off">
            <span class="absolute right-3 top-1/2 cursor-pointer" onclick="toggleVisibility('password', 'eyeIconPassword')">
                <i id="eyeIconPassword" class="fas fa-eye text-neutral-500"></i>
            </span>
        </div>
        <div class="grid relative">
            <label class="text-black" for="konfirmasiPassword">Konfirmasi Password</label>
            <input class="w-full p-2 rounded border bg-gray-100 border-gray-300 focus:outline-none" type="password" name="konfirmasiPassword" id="konfirmasiPassword" autocomplete="off">
            <span class="absolute right-3 top-1/2 cursor-pointer" onclick="toggleVisibility('konfirmasiPassword', 'eyeIconKonfirmasi')">
                <i id="eyeIconKonfirmasi" class="fas fa-eye text-neutral-500"></i>
            </span>
        </div>
        <div class="flex justify-end text-sm">
            <button type="submit" class="bg-blue-900 hover:bg-blue-950 text-white flex items-center gap-2 py-2 px-4 rounded-full">
                <span>Simpan</span>
            </butt>
        </div>
    </form>

    @if (session('success'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    title: "Berhasil!",
                    text: "{{ session('success') }}",
                    icon: "success",
                    timer: 2000,
                    showConfirmButton: false
                });
            });
        </script>
    @endif
@endsection
