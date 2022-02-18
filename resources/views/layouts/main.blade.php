<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <link rel="shortcut icon" href="{{ asset('img/logo/favicon.ico') }}">

        <title>@yield("title") - Movie App</title>

        @include('layouts.css')
        @yield('style')

        <script defer src="https://unpkg.com/alpinejs@3.9.0/dist/cdn.min.js"></script>
        @livewireStyles
    </head>
    <body class="font-sans bg-gray-900 text-white unscrollable">
        @include('layouts.preloader')
        @include('layouts.nav')
        @yield("content")
        @include('layouts.footer')
        @livewireScripts
        @yield("script")
        @include('layouts.js') 
    </body>
</html>