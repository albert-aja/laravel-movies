<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Movie App</title>

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script defer src="https://unpkg.com/alpinejs@3.9.0/dist/cdn.min.js"></script>
        @livewireStyles
    </head>
    <body class="font-sans bg-gray-900 text-white">
        @include('layouts.nav')
        @yield("content") 
        @include('layouts.footer')
        @livewireScripts
        @yield("script") 
    </body>
</html>