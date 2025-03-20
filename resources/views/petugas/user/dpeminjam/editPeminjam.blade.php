@extends('petugas.layout.layout')
@section('content')
    <div class="bg-white p-4 shadow rounded">
        <div class="flex flex-col lg:flex-row gap-8 items-start">
            <div class="w-full lg:w-1/4 flex justify-center">
                @if ($peminjam->foto == null) 
                    <img src="https://i.pinimg.com/736x/29/b8/d2/29b8d250380266eb04be05fe21ef19a7.jpg" alt="{{ $peminjam->nama }}" class="size-52 rounded-full object-cover">
                @else
                    <img src="{{ asset('storage/' . $peminjam->foto ) }}" alt="{{ $peminjam->nama }}" class="size-52 rounded-full object-cover">
                @endif
            </div>

            <div class="w-full lg:w-3/4 flex flex-col gap-4 text-sm lg:text-base">
                <div class="grid gap-4 text-sm mt-4">
                    <div class="grid">
                        <label class="mb-1" for="id">NIK</label>
                        <input type="text" name="id" id="id" class="w-full focus:outline-none p-2 rounded border bg-gray-100 border-gray-300 text-sm" value="{{ $peminjam->id }}" readonly>
                    </div>
                    <div class="grid">
                        <label class="mb-1" for="username">Username</label>
                        <input type="text" name="username" id="username" class="w-full focus:outline-none p-2 rounded border bg-gray-100 border-gray-300 text-sm" value="{{ $peminjam->nama }}" readonly>
                    </div>
                    <div class="grid">
                        <label class="mb-1" for="email">Email</label>
                        <input type="Email" name="email" id="email" class="w-full focus:outline-none p-2 rounded border bg-gray-100 border-gray-300 text-sm" value="{{ $peminjam->email }}" readonly>
                    </div>
                    <div class="grid">
                        <label class="mb-1" for="alamat">Alamat</label>
                        <div class="grid gap-4">
                            <input type="hidden" name="wilayah" id="wilayah">
        
                            @php
                                $alamat = json_decode($peminjam->alamat, true);
                            @endphp
        
                            <select name="provinsi" id="provinsi" class="w-full p-2 rounded border bg-gray-100 border-gray-300">
                                <option value="" disabled hidden>Pilih provinsi</option>
                                <option value="{{ $alamat['provinsi']['id'] ?? '' }}" selected>{{ $alamat['provinsi']['name'] ?? 'Pilih provinsi' }}</option>
                            </select>
                            <select name="kabupaten" id="kabupaten" class="w-full p-2 rounded border bg-gray-100 border-gray-300">
                                <option value="" disabled hidden>Pilih kabupaten</option>
                                <option value="{{ $alamat['kabupaten']['id'] ?? '' }}" selected>{{ $alamat['kabupaten']['name'] ?? 'Pilih kabupaten' }}</option>
                            </select>
                            <select name="kecamatan" id="kecamatan" class="w-full p-2 rounded border bg-gray-100 border-gray-300">
                                <option value="" disabled hidden>Pilih kecamatan</option>
                                <option value="{{ $alamat['kecamatan']['id'] ?? '' }}" selected>{{ $alamat['kecamatan']['name'] ?? 'Pilih kecamatan' }}</option>
                            </select>
                            <select name="kelurahan" id="kelurahan" class="w-full p-2 rounded border bg-gray-100 border-gray-300">
                                <option value="" disabled hidden>Pilih kelurahan</option>
                                <option value="{{ $alamat['kelurahan']['id'] ?? '' }}" selected>{{ $alamat['kelurahan']['name'] ?? 'Pilih kelurahan' }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="grid">
                        <label class="mb-1" for="email">Telepon</label>
                        <input type="Email" name="email" id="email" class="w-full focus:outline-none p-2 rounded border bg-gray-100 border-gray-300 text-sm" value="{{ $peminjam->telepon ?? "-" }}" readonly>
                    </div>
                </div>
                
                <div class="justify-between flex w-full items-center">
                    <div class="flex flex-row mt-2 gap-4 items-center text-sm">
                        <a href="{{ route('petugas.user.dpeminjam.detailPeminjam', $peminjam->id) }}" class="bg-blue-900 hover:bg-blue-950 text-white flex w-full items-center gap-2 py-2 px-4 rounded-full">
                            <i class="fa-solid fa-arrow-left text-sm"></i>
                            <span>Kembali</span>
                        </a>
                    </div>
                    <div class="flex flex-row mt-2 gap-4 items-center text-sm">
                        <a href="" class="bg-blue-900 hover:bg-blue-950 text-white flex w-full items-center gap-2 py-2 px-4 rounded-full">
                            <span>Simpan</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
