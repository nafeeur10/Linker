<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>
        <link rel="icon" type="image/x-icon" href="https://img.icons8.com/officel/20/harvester.png">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Lato:wght@400;700;900&family=Playfair+Display:wght@400;500;600;700;800&family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,900&family=Roboto+Serif:wght@400;700&family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
        <style>
            body {
                font-family: 'Raleway', sans-serif;
            }
        </style>
        @vite(['resources/js/app.js'])
        @vite('resources/css/app.css')
    </head>
    <body class="antialiased">
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
            <div class="max-w-7xl mx-auto p-6 lg:p-8 w-full">
                <div class="flex justify-center items-center">
                    <img width="80" height="80" src="https://img.icons8.com/officel/80/harvester.png" alt="harvester" />
                    <h1 class="text-6xl ml-5 font-extrabold">Linker</h1>
                </div>
                @yield('content')
            </div>
        </div>
        @stack('scripts')
    </body>
</html>
