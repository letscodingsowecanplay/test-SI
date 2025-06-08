<!DOCTYPE html>
<html lang="en" data-bs-theme="auto">
<head>
    <script src="{{ asset('js/color-modes.js') }}"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#712cf9">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Si Ukur</title>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/nouislider@15.6.1/dist/nouislider.min.css">
    <link rel="icon" sizes="180x180" href="{{ asset('ikon-si-ukur.ico') }}">
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dragdrop.css') }}" rel="stylesheet">
    @yield('styles')
    @stack('scripts')
</head>
<body class="bg-coksu">
    @include('admin.includes.navbar')
    <div class="container-fluid">
        <div class="row flex-nowrap">
            @include('admin.includes.sidebar')
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 position-relative">
                @include('admin.includes.breadcrumb')
                @include('admin.includes.flash')
                @yield('content')
            </main>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script>feather.replace()</script>
    @yield('scripts')
</body>
</html>
