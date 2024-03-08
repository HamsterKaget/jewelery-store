<!DOCTYPE html>
<html lang="en">
<head>
    {{-- ! : META START --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- ! : META END --}}


    <title>@yield('title', '') | WorldGemsCenter</title>
    <link rel="shortcut icon" href="{{ env('APP_URL', 'http://localhost') }}/dev/logo-wgc.png" type="image/x-icon">

    {{-- ! : CSS & CDN START --}}
    @stack('pre-css')
    @vite(['resources/css/app.css','resources/js/app.js'])
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @stack('post-css')
    {{-- ! : CSS & CDN END --}}

</head>
<body class="bg-slate-50 dark:bg-slate-800">
    @include('web.layout.sidebar')

    {{-- @yield('content') --}}

    @stack('pre-js')
    <script src="/js/helper.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    {{-- <script src="/js/helper.js"></script> --}}
    @stack('post-js')
</body>
</html>
