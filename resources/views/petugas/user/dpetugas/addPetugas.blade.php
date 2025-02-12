@extends('petugas.layout.layout')
@section('content')
    <form method="POST" action="{{ route('petugas.user.dpetugas.addPetugasAction') }}" class="bg-white p-4 shadow-md rounded">
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
                <label class="mb-1" for="username">Username</label>
                <input type="text" name="username" id="username" class="w-full p-2 rounded border bg-gray-100 border-gray-300 text-sm" value="{{ old('username') }}" placeholder="Masukan username" required>
            </div>
            <div class="grid">
                <label class="mb-1" for="email">Email</label>
                <input type="Email" name="email" id="email" class="w-full p-2 rounded border bg-gray-100 border-gray-300 text-sm" value="{{ old('email') }}" placeholder="Masukan email" required>
            </div>
            <div class="grid">
                <label class="mb-1" for="password">Password</label>
                <input type="password" name="password" id="password" class="w-full p-2 rounded border bg-gray-100 border-gray-300 text-sm" placeholder="Masukan password" required>
            </div>
            <div class="grid">
                <label class="mb-1" for="role">Hak Akses</label>
                <select name="role" id="role" class="w-full p-2 rounded border bg-gray-100 border-gray-300 text-sm cursor-pointer capitalize" required>
                    <option value="" disabled selected hidden>Pilih hak akses</option>
                    <option value="admin" class="capitalize">admin</option>
                    <option value="petugas" class="capitalize">petugas</option>
                </select>
            </div>
        </div>
        <div class="flex justify-end mt-4">
            <button class="bg-blue-900 py-2 px-3 text-sm rounded text-white">Tambah</button>
        </div>
    </form>
@endsection