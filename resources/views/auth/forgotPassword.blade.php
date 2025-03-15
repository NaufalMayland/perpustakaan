<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    @vite('resources/css/app.css')
    <title>Perpustakaan | {{$title}}</title>
</head>
<body class="bg-slate-50 font-['poppins']">
    <div class="w-auto h-screen items-center justify-center flex">
        <form action="{{ route('auth.forgotPasswordAction') }}" method="POST" class="w-fit bg-[#fff] shadow rounded px-6 py-8">
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
                        <label class="text-black" for="email">Email</label>
                        <input class="border border-gray-500 py-2 px-3 rounded w-full" type="email" id="email" name="email" autocomplete="off" value="{{ old('email') }}">
                    </div>
                    <div class="grid relative">
                        <label class="text-black" for="password">Password Baru</label>
                        <input class="border border-gray-500 py-2 px-3 rounded w-full" type="password" name="password" id="password" autocomplete="off" value="{{ old('password') }}">
                        <span class="absolute right-3 top-1/2 cursor-pointer" onclick="toggleVisibility('password', 'eyeIconPassword')">
                            <i id="eyeIconPassword" class="fas fa-eye text-neutral-500"></i>
                        </span>
                    </div>
                    <div class="grid relative">
                        <label class="text-black" for="konfirmasiPw">Konfirmasi Password</label>
                        <input class="border border-gray-500 py-2 px-3 rounded w-full" type="password" name="konfirmasiPw" id="konfirmasiPw" autocomplete="off">
                        <span class="absolute right-3 top-1/2 cursor-pointer" onclick="toggleVisibility('konfirmasiPw', 'eyeIconKonfirmasi')">
                            <i id="eyeIconKonfirmasi" class="fas fa-eye text-neutral-500"></i>
                        </span>
                    </div>
                </div>
                <div class="text-blue-900 hover:text-blue-950 text-sm">
                    <a href="{{ route('auth.login') }}">Kembali</a>
                </div>
                <div class="flex w-full items-center mt-4">
                    <button type="submit" class="text-sm font-semibold w-full bg-blue-900 rounded-full text-white py-2 px-4 hover:bg-blue-950">Konfirmasi</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        function toggleVisibility(inputId, eyeIconId) {
            const input = document.getElementById(inputId);
            const eyeIcon = document.getElementById(eyeIconId);
            
            if (input.type === 'password') {
                input.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
