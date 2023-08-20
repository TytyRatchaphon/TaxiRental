<!doctype html>
<html class="scroll-smooth" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - Honey Lemon</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    
    @include('layouts.subviews.navbar')

    <div>
        <main class="min-h-screen">
            @yield('content')
        </main>
    </div>
    
    <footer class=" bg-gradient-to-r from-[#f75394] to-yellow-300 text-white py-4 text-center">
        <p class="drop-shadow">&copy; {{ date('Y') }} HoneyLemon's Event Management Project. All rights reserved.</p>
    </footer>
    
</body>
</html>