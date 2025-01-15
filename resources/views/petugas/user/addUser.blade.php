@extends('petugas.layout.layout')
@section('content')
    <form method="POST" action="{{route('petugas.user.addUserAction')}}" class="bg-white p-4 shadow-md rounded">
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
        <div class="grid grid-cols-2 gap-4 text-sm mt-4">
            <div class="grid">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="w-full h-9 px-2 rounded bg-gray-100 border-gray-200 text-sm" value="{{ old('username') }}" required>
            </div>
            <div class="grid">
                <label for="email">Email</label>
                <input type="Email" name="email" id="email" class="w-full h-9 px-2 rounded bg-gray-100 border-gray-200 text-sm" value="{{ old('email') }}" required>
            </div>
            <div class="grid">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="w-full h-9 px-2 rounded bg-gray-100 border-gray-200 text-sm" required>
            </div>
            <div class="grid">
                <label for="role">Hak Akses</label>
                <select name="role" id="role" class="w-full h-9 px-2 rounded bg-gray-100 border-gray-200 text-sm" required>
                    <option value="" disabled selected hidden>Pilih Hak Akses</option>
                    @foreach ($roleData as $data)
                        <option value="{{$data->id}}" class="capitalize">{{$data->role}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="flex justify-end mt-4">
            <button class="bg-blue-600 py-2 px-3 text-sm rounded text-white">Tambah</button>
        </div>
    </form>
@endsection