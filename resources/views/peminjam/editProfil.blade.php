@extends('peminjam.layout.layout')
@section('content')
    <form action="{{ route('peminjam.editProfilAction') }}" method="POST" class="flex flex-col lg:flex-row gap-8 items-start">
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
                    <select name="provinsi" id="provinsi" class="w-full p-2 rounded border bg-gray-100 border-gray-300 focus:outline-none">
                        <option value="" disabled selected hidden>Pilih provinsi</option>
                    </select>
                    <input type="hidden" name="namaProvinsi" id="namaProvinsi">

                    <select name="kabupaten" id="kabupaten" class="w-full p-2 rounded border bg-gray-100 border-gray-300 focus:outline-none">
                        <option value="" disabled selected hidden>Pilih kabupaten</option>
                    </select>
                    <input type="hidden" name="namaKabupaten" id="namaKabupaten">

                    <select name="kecamatan" id="kecamatan" class="w-full p-2 rounded border bg-gray-100 border-gray-300 focus:outline-none">
                        <option value="" disabled selected hidden>Pilih kecamatan</option>
                    </select>
                    <input type="hidden" name="namaKecamatan" id="namaKecamatan">

                    <select name="kelurahan" id="kelurahan" class="w-full p-2 rounded border bg-gray-100 border-gray-300 focus:outline-none">
                        <option value="" disabled selected hidden>Pilih kelurahan</option>
                    </select>
                    <input type="hidden" name="namaKelurahan" id="namaKelurahan">
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

            $.get(`${baseUrl}/provinsi`, function(data) {
                $.each(data, function(index, value) {
                    $('#provinsi').append(`<option value="${value.id}" data-nama="${value.name}">${value.name}</option>`);
                });
            });

            $('#provinsi').change(function() {
                let provinsiId = $(this).val();
                let namaProvinsi = $(this).find(':selected').data('nama');
                $('#namaProvinsi').val(namaProvinsi);

                $('#kabupaten').empty().append('<option value="">Pilih Kabupaten</option>');
                $('#namaKabupaten, #namaKecamatan, #namaKelurahan').val('');

                if (provinsiId) {
                    $.get(`${baseUrl}/kabupaten/${provinsiId}`, function(data) {
                        $.each(data, function(index, value) {
                            $('#kabupaten').append(`<option value="${value.id}" data-nama="${value.name}">${value.name}</option>`);
                        });
                    });
                }
            });

            $('#kabupaten').change(function() {
                let kabupatenId = $(this).val();
                let namaKabupaten = $(this).find(':selected').data('nama');
                $('#namaKabupaten').val(namaKabupaten);

                $('#kecamatan').empty().append('<option value="">Pilih Kecamatan</option>');
                $('#namaKecamatan, #namaKelurahan').val('');

                if (kabupatenId) {
                    $.get(`${baseUrl}/kecamatan/${kabupatenId}`, function(data) {
                        $.each(data, function(index, value) {
                            $('#kecamatan').append(`<option value="${value.id}" data-nama="${value.name}">${value.name}</option>`);
                        });
                    });
                }
            });

            $('#kecamatan').change(function() {
                let kecamatanId = $(this).val();
                let namaKecamatan = $(this).find(':selected').data('nama');
                $('#namaKecamatan').val(namaKecamatan);

                $('#kelurahan').empty().append('<option value="">Pilih Kelurahan</option>');
                $('#namaKelurahan').val('');

                if (kecamatanId) {
                    $.get(`${baseUrl}/kelurahan/${kecamatanId}`, function(data) {
                        $.each(data, function(index, value) {
                            $('#kelurahan').append(`<option value="${value.id}" data-nama="${value.name}">${value.name}</option>`);
                        });
                    });
                }
            });

            $('#kelurahan').change(function() {
                let namaKelurahan = $(this).find(':selected').data('nama');
                $('#namaKelurahan').val(namaKelurahan);
            });
        });
    </script>
@endsection
