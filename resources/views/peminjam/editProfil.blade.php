@extends('peminjam.layout.layout')
@section('content')
    <form action="{{ route('peminjam.editProfilAction', $peminjam->id) }}" method="POST" class="flex flex-col lg:flex-row gap-8 items-start bg-white rounded shadow p-4" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="w-full lg:w-1/4 flex justify-center">
            <input type="file" name="foto" id="foto" class="hidden" accept="image/*" onchange="openCropModal(event)">
            <label for="foto" class="relative cursor-pointer group">
                <img src="{{ $peminjam->foto ? asset('storage/' . $peminjam->foto) : 'https://i.pinimg.com/736x/29/b8/d2/29b8d250380266eb04be05fe21ef19a7.jpg' }}" alt="{{ $peminjam->nama }}" id="preview" class="size-60 rounded-full object-cover transition duration-100 ease-in-out group-hover:opacity-50 z-0">
                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 3.487a2.25 2.25 0 113.182 3.182L7.05 19.663a4.5 4.5 0 01-1.591 1.045L3 21l.292-2.459a4.5 4.5 0 011.045-1.591L16.862 3.487z" />
                    </svg>
                </div>
            </label>
            <input type="hidden" name="cropped_image" id="cropped_image">
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
                <label for="telepon">Telepon</label>
                <input type="text" name="telepon" id="telepon" min="1800" max="2100" class="w-full p-2 rounded border bg-gray-100 border-gray-300" value="{{ $peminjam->telepon}}">
            </div>
            
            <div class="justify-between flex w-full items-center">
                <div class="flex flex-row mt-2 gap-4 items-center text-sm">
                    <a href="{{ route('peminjam.profil') }}" class="bg-blue-900 hover:bg-blue-950 text-white flex w-full items-center gap-2 py-2 px-4 rounded-full">
                        <i class="fa-solid fa-arrow-left text-sm"></i>
                        <span>Kembali</span>
                    </a>
                </div>
                <div class="flex flex-row mt-2 gap-4 items-center text-sm">
                    <button type="submit" class="bg-blue-900 hover:bg-blue-950 text-white flex w-full items-center gap-2 py-2 px-4 rounded-full">Simpan</button>
                </div>
            </div>
        </div>
    </form>

    <div id="cropModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center z-20">
        <div class="bg-white p-4 rounded-lg w-96">
            <div class="crop-container">
                <img id="cropImage" class="max-w-full">
            </div>
            <div class="flex justify-between gap-4 mt-4">
                <button type="button" onclick="closeCropModal()" class="bg-neutral-500 text-white px-4 py-2 rounded-full">Batal</button>
                <button type="button" onclick="cropImage()" class="bg-blue-900 text-white px-4 py-2 rounded-full">Simpan</button>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css">

    <script>
        let cropper;

        function openCropModal(event) {
            console.log('openCropModal triggered'); 
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const cropImage = document.getElementById('cropImage');
                    cropImage.src = e.target.result;
                    document.getElementById('cropModal').classList.remove('hidden');

                    if (cropper) {
                        cropper.destroy();
                    }

                    cropper = new Cropper(cropImage, {
                        aspectRatio: 1,
                        viewMode: 1,
                        autoCropArea: 1
                    });

                    console.log('Cropper initialized');
                };
                reader.readAsDataURL(file);
            } else {
                console.log('No file selected');
            }
        }


        function closeCropModal() {
            document.getElementById('cropModal').classList.add('hidden');
            if (cropper) cropper.destroy();
        }

        function cropImage() {
            const canvas = cropper.getCroppedCanvas();
            if (canvas) {
                const preview = document.getElementById('preview');
                preview.src = canvas.toDataURL();
                document.getElementById('cropped_image').value = canvas.toDataURL();
                document.getElementById('cropModal').classList.add('hidden');

                const fotoInput = document.getElementById('foto');
                fotoInput.value = '';
            }
        }

        $(document).ready(function() {
            let baseUrl = "/perpustakaan/profil";

            function updateWilayah() {
            let provinsi = $('#provinsi').val();
            let kabupaten = $('#kabupaten').val();
            let kecamatan = $('#kecamatan').val();
            let kelurahan = $('#kelurahan').val();

            if (provinsi && kabupaten && kecamatan && kelurahan) {
                let wilayah = {
                    provinsi: {
                        id: provinsi,
                        name: $('#provinsi option:selected').text()
                    },
                    kabupaten: {
                        id: kabupaten,
                        name: $('#kabupaten option:selected').text()
                    },
                    kecamatan: {
                        id: kecamatan,
                        name: $('#kecamatan option:selected').text()
                    },
                    kelurahan: {
                        id: kelurahan,
                        name: $('#kelurahan option:selected').text()
                    }
                };
                $('#wilayah').val(JSON.stringify(wilayah));
            } else {
                $('#wilayah').val('');
            }
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

            updateWilayah();
        });
    </script>
@endsection
