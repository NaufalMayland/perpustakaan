@extends('petugas.layout.layout')
@section('content')
    <form method="POST" action="{{route('petugas.user.dpeminjam.addPeminjamAction')}}" class="bg-white p-4 shadow rounded">
        @csrf
        @if ($errors->any())
            <div class="bg-red-500 text-white text-sm p-3 rounded text-center w-full">
                <ul>
                    @foreach ($errors->all() as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="grid gap-4 text-sm mt-4">
            <div class="grid">
                <label for="nik">NIK</label>
                <input type="text" name="nik" id="nik" class="w-full p-2 rounded border bg-gray-100 border-gray-300 text-sm" value="{{ old('nik') }}" placeholder="Masukan username" autocomplete="off" required>
            </div>
            <div class="grid">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="w-full p-2 rounded border bg-gray-100 border-gray-300 text-sm" value="{{ old('username') }}" placeholder="Masukan username" autocomplete="off" required>
            </div>
            <div class="grid">
                <label for="email">Email</label>
                <input type="Email" name="email" id="email" class="w-full p-2 rounded border bg-gray-100 border-gray-300 text-sm" value="{{ old('email') }}" placeholder="Masukan email" autocomplete="off" required>
            </div>
            <div class="grid">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="w-full p-2 rounded border bg-gray-100 border-gray-300 text-sm" placeholder="Masukan password" autocomplete="off" required>
            </div>
        </div>
        <div class="flex justify-end mt-4">
            <button class="bg-blue-900 py-2 px-3 text-sm rounded-full text-white">Tambah</button>
        </div>
    </form>
@endsection