<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    @vite('resources/css/app.css')
    <title>{{ $title }}</title>
</head>
<body class="font-['poppins']">
    <div id="loading-screen" class="fixed inset-0 bg-white flex flex-col items-center justify-center z-50 transition-opacity duration-500">
        <div class="text-center text-blue-900">
            <p id="typing-text" class="text-3xl font-bold"></p>
        </div>
    </div>

    @include('auth.layout.nav')

    <div class="">
        @yield('content')
    </div>

    <div class="bg-blue-900 text-white py-6 mt-10 z-20">
        <div class="mx-auto flex flex-col md:flex-row justify-between items-center px-6">
            <div class="text-center md:text-left mb-4 md:mb-0">
                <h2 class="text-lg font-semibold">MyLibrary</h2>
            </div>
            <div class="flex gap-4">
                <a href="#" class="hover:text-gray-300"><i class="fa-brands fa-facebook text-xl"></i></a>
                <a href="#" class="hover:text-gray-300"><i class="fa-brands fa-twitter text-xl"></i></a>
                <a href="#" class="hover:text-gray-300"><i class="fa-brands fa-instagram text-xl"></i></a>
            </div>
            <div class="text-center md:text-right text-sm mt-4 md:mt-0">
                &copy; 2025 MyLibrary. All rights reserved.
            </div>
        </div>
    </div>
</body>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const text = "MyLibrary";
        let index = 0;
        const typingText = document.getElementById("typing-text");
        
        function typeEffect() {
            if (index < text.length) {
                typingText.textContent += text.charAt(index);
                index++;
                setTimeout(typeEffect, 200);
            } else {
                setTimeout(() => {
                    document.getElementById("loading-screen").classList.add("opacity-0");
                    setTimeout(() => {
                        document.getElementById("loading-screen").style.display = "none";
                    }, 500);
                }, 1000);
            }
        }
        
        typeEffect();
    });
</script>

</html>