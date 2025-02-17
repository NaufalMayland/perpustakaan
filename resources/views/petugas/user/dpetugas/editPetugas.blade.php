@extends('petugas.layout.layout')
@section('content')
    <div class="bg-white p-4 shadow-md rounded">
        <div class="flex flex-col lg:flex-row gap-8 items-start">
            <div class="w-full lg:w-1/4 flex justify-center">
                <img src="" alt="foto" class="w-full rounded bg-cover">
            </div>

            <div class="w-full lg:w-3/4 flex flex-col gap-4 text-sm lg:text-base">
                <div class="grid gap-4 text-sm mt-4">
                    <div class="grid">
                        <label class="mb-1" for="username">Username</label>
                        <input type="text" name="username" id="username" class="w-full p-2 rounded border bg-gray-100 border-gray-300 text-sm" value="{{ $petugas->nama }}">
                    </div>
                    <div class="grid">
                        <label class="mb-1" for="email">Email</label>
                        <input type="Email" name="email" id="email" class="w-full p-2 rounded border bg-gray-100 border-gray-300 text-sm" value="{{ $petugas->email }}">
                    </div>
                    <div class="grid">
                        <label class="mb-1" for="email">Alamat</label>
                        <div class="grid gap-4">
                            <select name="kota" id="kota" class="w-full p-2 rounded border bg-gray-100 border-gray-300 text-sm">
                                <option value="" disabled selected hidden>Pilih kota</option>
                            </select>
                            <select name="kabupaten" id="kabupaten" class="w-full p-2 rounded border bg-gray-100 border-gray-300 text-sm">
                                <option value="" disabled selected hidden>Pilih kabupaten</option>
                            </select>
                            <select name="kecamatan" id="kecamatan" class="w-full p-2 rounded border bg-gray-100 border-gray-300 text-sm">
                                <option value="" disabled selected hidden>Pilih kecamatan</option>
                            </select>
                            <select name="kelurahan" id="kelurahan" class="w-full p-2 rounded border bg-gray-100 border-gray-300 text-sm">
                                <option value="" disabled selected hidden>Pilih kelurahan</option>
                            </select>
                        </div>
                    </div>
                    <div class="grid">
                        <label class="mb-1" for="email">Telepon</label>
                        <input type="Email" name="email" id="email" class="w-full p-2 rounded border bg-gray-100 border-gray-300 text-sm" value="{{ $petugas->telepon }}">
                    </div>
                </div>
                
                <div class="justify-between flex w-full items-center">
                    <div class="flex flex-row mt-2 gap-4 items-center text-sm">
                        <a href="{{ route('petugas.user.dpetugas.detailPetugas', $petugas->id) }}" class="bg-blue-900 hover:bg-blue-950 text-white flex w-full items-center gap-2 py-2 px-4 rounded">
                            <i class="fa-solid fa-arrow-left text-sm"></i>
                            <span>Kembali</span>
                        </a>
                    </div>
                    <div class="flex flex-row mt-2 gap-4 items-center text-sm">
                        <a href="" class="bg-blue-900 hover:bg-blue-950 text-white flex w-full items-center gap-2 py-2 px-4 rounded">
                            <i class="fa-solid fa-pencil text-sm"></i>
                            <span>Edit</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
