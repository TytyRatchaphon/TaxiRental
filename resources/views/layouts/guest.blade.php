<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class=" text-white antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            
            <div class="flex flex-col justify-center">
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-white" />
                </a>
                <p class="text-gray-900 text-[3vh] font-semibold duration-300 relative transform transition-all translate-y-8 ease-out opacity-0" data-replace='{ "translate-y-8": "translate-y-0", "opacity-0": "opacity-100" }'>Taxi-Rental</p>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>

    <script src="{{ asset('js/data-replacer.js') }}"></script>
</html>
