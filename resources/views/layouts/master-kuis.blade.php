<!-- resources/views/layouts/master-kuis.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #ffc0cb;
            font-family: Arial, sans-serif;
        }
        .container-kuis {
            display: flex;
            flex-direction: row;
            gap: 20px;
        }
        .soal-section {
            flex: 2;
            background: white;
            padding: 20px;
            border-radius: 12px;
        }
        .navigasi-section {
            flex: 1;
            background: #ffe4ec;
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
            background-color: #ff69b4;
            color: white;
            border-color: #ff69b4;
        }
        audio {
            height: 30px;
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
