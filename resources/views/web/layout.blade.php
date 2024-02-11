<!DOCTYPE html>
<html lang="en">
<head>
    {{-- ! : META START --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- ! : META END --}}


    <title>@yield('title', '') | WorldGemsCenter</title>
    <link rel="shortcut icon" href="/dev/logo-wgc.png" type="image/x-icon">

    {{-- ! : CSS & CDN START --}}
    @stack('pre-css')
    @vite(['resources/css/app.css','resources/js/app.js'])
    {{-- <link rel="preconnect" href="https://fonts.bunny.net"> --}}
    {{-- <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" /> --}}
    @stack('post-css')
    {{-- ! : CSS & CDN END --}}

</head>
<body class="bg-slate-50 dark:bg-slate-800">
    @include('web.layout.sidebar')

    {{-- @yield('content') --}}

    @stack('pre-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    {{-- <script src="/js/helper.js"></script> --}}
    @stack('post-js')
</body>
</html>
