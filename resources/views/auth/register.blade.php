<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <title>Perpustakaan | {{$title}}</title>
</head>
<body class="bg-slate-50 font-['poppins']">
    <div class="w-auto h-screen items-center justify-center flex">
        <form action="{{ route('auth.registerAction') }}" method="POST" class="w-fit bg-[#fff] shadow-md rounded px-6 py-8">
            @csrf
            <div class="w-80">
                <div class="text-2xl text-blue-900 font-bold w-full text-center mb-8">
                    <h1>PERPUSTAKAAN</h1>
                </div>
                @if ($errors->any())
                    <div class="bg-red-500 text-white text-sm p-2 rounded text-left w-full">
                        <ul>
                            @foreach ($errors->all() as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="grid text-sm gap-2 my-4">
                    <div class="grid">
                        <label class="text-black" for="username">Username</label>
                        <input class="border border-gray-500 py-2 px-3 rounded w-full" type="text" id="username" name="username" autocomplete="off" value="{{old('username')}}">
                    </div>
                    <div class="grid">
                        <label class="text-black" for="email">Email</label>
                        <input class="border border-gray-500 py-2 px-3 rounded w-full" type="email" id="email" name="email" autocomplete="off" value="{{old('email')}}">
                    </div>
                    <div class="grid">
                        <label class="text-black" for="password">Password</label>
                        <input class="border border-gray-500 py-2 px-3 rounded w-full" type="password" name="password" id="password" autocomplete="off">
                    </div>
                </div>
                <div class="flex justify-between items-center mt-8">
                    <div class="text-blue-900 hover:text-blue-950 text-sm">
                        <a href="{{route('auth.login')}}">Sudah punya akun?</a>
                    </div>
                    <div class="">
                        <button type="submit" class="text-sm font-semibold bg-blue-900 rounded text-white py-2 px-4 hover:bg-blue-950">Register</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
</html>