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
                <p class="mt-2 fw-semibold d-flex justify-content-center align-items-center gap-2">
                    Pensil ini lebih pendek.
                    <button onclick="playSound('gambar1')" class="btn btn-sm btn-outline-dark bg-coklapbet text-white">🔊</button>
                    <audio id="audio-gambar1" src="{{ asset('sounds/materi/gambar1.mp3') }}"></audio>
                </p>
            </div>
            <div class="col-md-6 mb-3">
                <img src="{{ asset('images/materi/jukung-mini.png') }}" class="img-fluid rounded shadow" alt="Pensil Panjang">
                <p class="mt-2 fw-semibold d-flex justify-content-center align-items-center gap-2">
                    Pensil ini lebih panjang.
                    <button onclick="playSound('gambar2')" class="btn btn-sm btn-outline-dark bg-coklapbet text-white">🔊</button>
                    <audio id="audio-gambar2" src="{{ asset('sounds/materi/gambar2.mp3') }}"></audio>
                </p>
            </div>
        </div>

        {{-- Gambar dan Kalimat 2 --}}
        <div class="row text-center my-4">
            <div class="col-md-6 mb-3">
                <img src="{{ asset('images/materi/rumahadat-big.png') }}" class="img-fluid rounded shadow" alt="Sedotan Panjang">
                <p class="mt-2 fw-semibold d-flex justify-content-center align-items-center gap-2">
                    Sedotan ini panjang.
                    <button onclick="playSound('gambar3')" class="btn btn-sm btn-outline-dark bg-coklapbet text-white">🔊</button>
                    <audio id="audio-gambar3" src="{{ asset('sounds/materi/gambar3.mp3') }}"></audio>
                </p>
            </div>
            <div class="col-md-6 mb-3">
                <img src="{{ asset('images/materi/rumahadat-mini.png') }}" class="img-fluid rounded shadow" alt="Sedotan Pendek">
                <p class="mt-2 fw-semibold d-flex justify-content-center align-items-center gap-2">
                    Sedotan ini pendek.
                    <button onclick="playSound('gambar4')" class="btn btn-sm btn-outline-dark bg-coklapbet text-white">🔊</button>
                    <audio id="audio-gambar4" src="{{ asset('sounds/materi/gambar4.mp3') }}"></audio>
                </p>
            </div>
        </div>

        {{-- Gambar dan Kalimat 3 --}}
        <div class="row text-center my-4">
            <div class="col-md-6 mb-3">
                <img src="{{ asset('images/materi/bekantan-big.png') }}" class="img-fluid rounded shadow" alt="Penggaris Panjang">
                <p class="mt-2 fw-semibold d-flex justify-content-center align-items-center gap-2">
                    Penggaris kayu ini lebih panjang.
                    <button onclick="playSound('gambar5')" class="btn btn-sm btn-outline-dark bg-coklapbet text-white">🔊</button>
                    <audio id="audio-gambar5" src="{{ asset('sounds/materi/gambar5.mp3') }}"></audio>
                </p>
            </div>
            <div class="col-md-6 mb-3">
                <img src="{{ asset('images/materi/bekantan-mini.png') }}" class="img-fluid rounded shadow" alt="Penggaris Pendek">
                <p class="mt-2 fw-semibold d-flex justify-content-center align-items-center gap-2">
                    Penggaris plastik ini lebih pendek.
                    <button onclick="playSound('gambar6')" class="btn btn-sm btn-outline-dark bg-coklapbet text-white">🔊</button>
                    <audio id="audio-gambar6" src="{{ asset('sounds/materi/gambar6.mp3') }}"></audio>
                </p>
            </div>
        </div>

        {{-- Dua Paragraf --}}
        <div class="mt-2">
            <p class="d-flex justify-content-between align-items-start gap-2">
                Ukuran panjang dan pendek digunakan untuk membandingkan jarak dari ujung ke ujung suatu benda. Benda dengan jarak yang lebih jauh disebut panjang, sedangkan benda dengan jarak lebih dekat disebut pendek.
               <button onclick="playSound('paragraf1')" class="btn btn-sm btn-outline-dark bg-coklapbet text-white mt-1">🔊</button>
                <audio id="audio-paragraf1" src="{{ asset('sounds/materi/paragraf1.mp3') }}"></audio>
            </p>
            <p class="d-flex justify-content-between align-items-start gap-2">
                Tinggi dan rendah adalah ukuran yang digunakan untuk membandingkan ketinggian suatu benda dari dasar ke atas. Benda yang memiliki jarak vertikal lebih jauh disebut tinggi, sedangkan benda dengan jarak vertikal lebih dekat disebut rendah.
                <button onclick="playSound('paragraf2')" class="btn btn-sm btn-outline-dark bg-coklapbet text-white mt-1">🔊</button>
                <audio id="audio-paragraf2" src="{{ asset('sounds/materi/paragraf2.mp3') }}"></audio>
            </p>
        </div>

    </div>

    <div class="card-footer d-flex justify-content-between">
        <a href="{{ route('admin.materi.halaman2') }}" class="btn btn-secondary">← Halaman 2</a>
        <a href="{{ route('admin.materi.halaman4') }}" class="btn btn-primary">Halaman 4 →</a>
    </div>
</div>
<br>
@endsection

@section('scripts')
<script>
    function playSound(id) {
        // Stop semua audio aktif
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
