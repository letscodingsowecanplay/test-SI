<!-- resources/views/layouts/master-kuis.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Si Ukur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="icon" sizes="180x180" href="{{ asset('ikon-si-ukur.ico') }}">

    <style>
        body {
            background-color: #fffbe9;
            font-family: Arial, sans-serif;
        }
        .container-kuis {
            display: flex;
            flex-direction: row;
            gap: 20px;
        }
        .soal-section {
            flex: 2;
            background: #e3caa5;
            padding: 20px;
            border-radius: 12px;
        }
        .navigasi-section {
            flex: 1;
            background: #e3caa5;
            padding: 20px;
            border-radius: 12px;
            height: fit-content;
        }
        .question-title {
            font-weight: bold;
            font-size: 18px;
        }
        .btn-nav {
            margin: 5px;
        }
        .btn-outline-dark.active {
            background-color: #4E1F00;
            color: white;
            border-color: #4E1F00;
        }
        audio {
            height: 30px;
            background-color: #4E1F00;
        }

        .bg-coklap {
            background-color: #4E1F00;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
