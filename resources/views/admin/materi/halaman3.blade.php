@extends('layouts.master')

@section('content')

<div class="card bg-coklat">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Pengukuran</h4>
    </div>
    <div class="card-body">

        {{-- Gambar dan Kalimat 1 --}}
        <div class="row text-center my-4">
            <div class="col-md-6 mb-3">
                <img src="{{ asset('images/materi/jukung-big.png') }}" class="img-fluid rounded shadow" alt="Pensil Pendek">
                <p class="mt-2 fw-semibold">
                    jukung berukuran panjang 
                    <button onclick="playSound('gambar1')" class="btn btn-sm btn-outline-dark bg-coklapbet text-white">🔊</button>
                    <audio id="audio-hal3-1" src="{{ asset('sounds/materi/hal3/1.mp3') }}"></audio>
                </p>
            </div>
            <div class="col-md-6 mb-3">
                <img src="{{ asset('images/materi/jukung-mini.png') }}" class="img-fluid rounded shadow" alt="Pensil Panjang">
                <p class="mt-2 fw-semibold">
                    miniatur jukung berukuran pendek 
                    <button onclick="playSound('gambar2')" class="btn btn-sm btn-outline-dark bg-coklapbet text-white">🔊</button>
                    <audio id="audio-hal3-2" src="{{ asset('sounds/materi/hal3/2.mp3') }}"></audio>
                </p>
            </div>
        </div>

        {{-- Gambar dan Kalimat 2 --}}
        <div class="row text-center my-4">
            <div class="col-md-6 mb-3">
                <img src="{{ asset('images/materi/rumahadat-big.png') }}" class="img-fluid rounded shadow" alt="Sedotan Panjang">
                <p class="mt-2 fw-semibold">
                    rumah adat banjar Anjung Surung itu tinggi 
                    <button onclick="playSound('gambar3')" class="btn btn-sm btn-outline-dark bg-coklapbet text-white">🔊</button>
                    <audio id="audio-hal3-3" src="{{ asset('sounds/materi/hal3/3.mp3') }}"></audio>
                </p>
            </div>
            <div class="col-md-6 mb-3">
                <img src="{{ asset('images/materi/rumahadat-mini.png') }}" class="img-fluid rounded shadow" alt="Sedotan Pendek">
                <p class="mt-2 fw-semibold">
                    miniatur rumah adat banjar Tadah alas itu rendah 
                    <button onclick="playSound('gambar4')" class="btn btn-sm btn-outline-dark bg-coklapbet text-white">🔊</button>
                    <audio id="audio-hal3-4" src="{{ asset('sounds/materi/hal3/4.mp3') }}"></audio>
                </p>
            </div>
        </div>

        {{-- Gambar dan Kalimat 3 --}}
        <div class="row text-center my-4">
            <div class="col-md-6 mb-3">
                <img src="{{ asset('images/materi/bekantan-big.png') }}" class="img-fluid rounded shadow" alt="Penggaris Panjang">
                <p class="mt-2 fw-semibold">
                    Patung bekantan itu tinggi 
                    <button onclick="playSound('gambar5')" class="btn btn-sm btn-outline-dark bg-coklapbet text-white">🔊</button>
                    <audio id="audio-hal3-5" src="{{ asset('sounds/materi/hal3/5.mp3') }}"></audio>
                </p>
            </div>
            <div class="col-md-6 mb-3">
                <img src="{{ asset('images/materi/bekantan-mini.png') }}" class="img-fluid rounded shadow" alt="Penggaris Pendek">
                <p class="mt-2 fw-semibold">
                    miniatur bekantan itu rendah 
                    <button onclick="playSound('gambar6')" class="btn btn-sm btn-outline-dark bg-coklapbet text-white">🔊</button>
                    <audio id="audio-hal3-6" src="{{ asset('sounds/materi/hal3/6.mp3') }}"></audio>
                </p>
            </div>
        </div>

        {{-- Dua Paragraf --}}
        <div class="mt-2">
            <p>
                Ukuran panjang dan pendek digunakan untuk membandingkan jarak dari ujung ke ujung suatu benda. Benda dengan jarak yang lebih jauh disebut panjang, sedangkan benda dengan jarak lebih dekat disebut pendek.
                <button onclick="playSound('paragraf1')" class="btn btn-sm btn-outline-dark bg-coklapbet text-white">🔊</button>
                <audio id="audio-hal3-7" src="{{ asset('sounds/materi/hal3/7.mp3') }}"></audio>
            </p>
            <p>
                Tinggi dan rendah adalah ukuran yang digunakan untuk membandingkan ketinggian suatu benda dari dasar ke atas. Benda yang memiliki jarak vertikal lebih jauh disebut tinggi, sedangkan benda dengan jarak vertikal lebih dekat disebut rendah.
                <button onclick="playSound('paragraf2')" class="btn btn-sm btn-outline-dark bg-coklapbet text-white">🔊</button>
                <audio id="audio-hal3-8" src="{{ asset('sounds/materi/hal3/8.mp3') }}"></audio>
            </p>
        </div>

    </div>

    <div class="card-footer d-flex justify-content-between">
        <a href="{{ route('admin.materi.halaman2') }}" class="btn btn-secondary">← Sebelumnya</a>
        <a href="{{ route('admin.materi.halaman4') }}" class="btn btn-primary">Selanjutnya →</a>
    </div>
</div>
<br>
@endsection

@section('scripts')
<script>
    function playSound(id) {
        document.querySelectorAll('audio').forEach(audio => {
            audio.pause();
            audio.currentTime = 0;
        });

        const audio = document.getElementById(`audio-${id}`);
        if (audio) {
            audio.play();
        }
    }
</script>
@endsection