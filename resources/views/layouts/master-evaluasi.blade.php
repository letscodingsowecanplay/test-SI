<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Halaman Kuis' }}</title>
    
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/kuis.css') }}">
    @vite(['resources/js/app.js']) {{-- Bootstrap, dll --}}
    @yield('styles')

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let countdown = {{ $sisa_waktu ?? 0 }};
            const timerEl = document.querySelector('.text-danger');

            const interval = setInterval(() => {
                if (countdown <= 0) {
                    clearInterval(interval);
                    alert("Waktu habis! Anda akan diarahkan ke halaman selesai.");
                    window.location.href = "{{ route('evaluasi.selesai') }}";
                } else {
                    let minutes = Math.floor(countdown / 60);
                    let seconds = countdown % 60;
                    timerEl.innerHTML = `<i class="bi bi-clock"></i> ${minutes}:${seconds.toString().padStart(2, '0')}`;
                    countdown--;
                }
            }, 1000);
        });
    </script>

</head>
<body class="bg-light">

    <main class="container-fluid p-3">
        @yield('content')
    </main>

    @yield('scripts')
</body>
</html>
