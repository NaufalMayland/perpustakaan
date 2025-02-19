@extends('peminjam.layout.layout')
@section('content')
    <form action="{{ route('peminjam.editProfilAction', $peminjam->id) }}" method="POST" class="flex flex-col lg:flex-row gap-8 items-start">
        @csrf
        @method('PUT')
        <div class="w-full lg:w-1/4 flex justify-center">
            <img src="" alt="Cover Buku" class="w-full rounded bg-cover">
        </div>
        <div class="w-full lg:w-3/4 flex flex-col gap-4  lg:text-base">
            <div class="grid">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" class="w-full p-2 rounded border bg-gray-100 border-gray-300 focus:outline-none" value="{{ $peminjam->nama }}" readonly>
            </div>
            <div class="grid">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" class="w-full p-2 rounded border bg-gray-100 border-gray-300 focus:outline-none" value="{{ $peminjam->email }}" readonly>
            </div>
            <div class="grid">
                <label for="alamat">Alamat</label>
                <div class="grid gap-4">
                    <input type="hidden" name="wilayah" id="wilayah">

                    <select name="provinsi" id="provinsi" class="w-full p-2 rounded border bg-gray-100 border-gray-300 focus:outline-none">
                        <option value="" disabled selected hidden>Pilih provinsi</option>
                    </select>
                    <select name="kabupaten" id="kabupaten" class="w-full p-2 rounded border bg-gray-100 border-gray-300 focus:outline-none">
                        <option value="" disabled selected hidden>Pilih kabupaten</option>
                    </select>
                    <select name="kecamatan" id="kecamatan" class="w-full p-2 rounded border bg-gray-100 border-gray-300 focus:outline-none">
                        <option value="" disabled selected hidden>Pilih kecamatan</option>
                    </select>
                    <select name="kelurahan" id="kelurahan" class="w-full p-2 rounded border bg-gray-100 border-gray-300 focus:outline-none">
                        <option value="" disabled selected hidden>Pilih kelurahan</option>
                    </select>
                </div>
            </div>
            <div class="grid">
                <label for="telepon">Telepon</label>
                <input type="text" name="telepon" id="telepon" min="1800" max="2100" class="w-full p-2 rounded border bg-gray-100 border-gray-300 focus:outline-none" value="{{ $peminjam->telepon}}">
            </div>
            
            <div class="justify-between flex w-full items-center">
                <div class="flex flex-row mt-2 gap-4 items-center text-sm">
                    <a href="{{ route('peminjam.profil') }}" class="bg-blue-900 hover:bg-blue-950 text-white flex w-full items-center gap-2 py-2 px-4 rounded">
                        <i class="fa-solid fa-arrow-left text-sm"></i>
                        <span>Kembali</span>
                    </a>
                </div>
                <div class="flex flex-row mt-2 gap-4 items-center text-sm">
                    <button type="submit" class="bg-blue-900 hover:bg-blue-950 text-white flex w-full items-center gap-2 py-2 px-4 rounded">Simpan</button>
                </div>
            </div>
        </div>
    </form>

    <script>
        $(document).ready(function() {
            let baseUrl = "/perpustakaan/profil";

            function updateWilayah() {
                let wilayah = 
                {
                    provinsi: {
                        id: $('#provinsi').val(),
                        name: $('#provinsi option:selected').text()
                    },
                    kabupaten: {
                        id: $('#kabupaten').val(),
                        name: $('#kabupaten option:selected').text()
                    },
                    kecamatan: {
                        id: $('#kecamatan').val(),
                        name: $('#kecamatan option:selected').text()
                    },
                    kelurahan: {
                        id: $('#kelurahan').val(),
                        name: $('#kelurahan option:selected').text()
                    }
                };
                $('#wilayah').val(JSON.stringify(wilayah));
            }

            $.get(`${baseUrl}/provinsi`, function(data) {
                $.each(data, function(index, value) {
                    $('#provinsi').append(`<option value="${value.id}">${value.name}</option>`);
                });
            });

            $('#provinsi').change(function() {
                let idProvinsi = $(this).val();
                $('#kabupaten').empty().append('<option value="">Pilih Kabupaten</option>');

                if (idProvinsi) {
                    $.get(`${baseUrl}/kabupaten/${idProvinsi}`, function(data) {
                        $.each(data, function(index, value) {
                            $('#kabupaten').append(`<option value="${value.id}">${value.name}</option>`);
                        });
                    });
                }
                updateWilayah();
            });

            $('#kabupaten').change(function() {
                let idKabupaten = $(this).val();
                $('#kecamatan').empty().append('<option value="">Pilih Kecamatan</option>');

                if (idKabupaten) {
                    $.get(`${baseUrl}/kecamatan/${idKabupaten}`, function(data) {
                        $.each(data, function(index, value) {
                            $('#kecamatan').append(`<option value="${value.id}">${value.name}</option>`);
                        });
                    });
                }
                updateWilayah();
            });

            $('#kecamatan').change(function() {
                let idKecamatan = $(this).val();
                $('#kelurahan').empty().append('<option value="">Pilih Kelurahan</option>');

                if (idKecamatan) {
                    $.get(`${baseUrl}/kelurahan/${idKecamatan}`, function(data) {
                        $.each(data, function(index, value) {
                            $('#kelurahan').append(`<option value="${value.id}">${value.name}</option>`);
                        });
                    });
                }
                updateWilayah();
            });

            $('#kelurahan').change(updateWilayah);
        });
    </script>
@endsection
