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
                    Jukung memiliki bentuk yang panjang. 
                    <button onclick="toggleAudio(this)" 
                            class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2"
                            data-id="index-1" data-playing="false">🔊</button>
                    <audio id="audio-index-1" src="{{ asset('sounds/materi/hal3/1.mp3') }}"></audio>
                </p>
            </div>
            <div class="col-md-6 mb-3">
                <img src="{{ asset('images/materi/jukung-mini.png') }}" class="img-fluid rounded shadow" alt="Pensil Panjang">
                <p class="mt-2 fw-semibold">
                    Miniatur jukung memiliki bentuk yang pendek.
                    <button onclick="toggleAudio(this)" 
                            class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2"
                            data-id="index-2" data-playing="false">🔊</button>
                    <audio id="audio-index-2" src="{{ asset('sounds/materi/hal3/2.mp3') }}"></audio>
                </p>
            </div>
        </div>

        {{-- Gambar dan Kalimat 2 --}}
        <div class="row text-center my-4">
            <div class="col-md-6 mb-3">
                <img src="{{ asset('images/materi/rumahadat-big.png') }}" class="img-fluid rounded shadow" alt="Sedotan Panjang">
                <p class="mt-2 fw-semibold">
                    Rumah Adat Banjar Anjung Surung memiliki bentuk yang tinggi.
                    <button onclick="toggleAudio(this)" 
                            class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2"
                            data-id="index-3" data-playing="false">🔊</button>
                    <audio id="audio-index-3" src="{{ asset('sounds/materi/hal3/3.mp3') }}"></audio>
                </p>
            </div>
            <div class="col-md-6 mb-3">
                <img src="{{ asset('images/materi/rumahadat-mini.png') }}" class="img-fluid rounded shadow" alt="Sedotan Pendek">
                <p class="mt-2 fw-semibold">
                    Miniatur Rumah Adat Banjar Tadah Alas memiliki bentuk yang rendah.
                    <button onclick="toggleAudio(this)" 
                            class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2"
                            data-id="index-4" data-playing="false">🔊</button>
                    <audio id="audio-index-4" src="{{ asset('sounds/materi/hal3/4.mp3') }}"></audio>
                </p>
            </div>
        </div>

        {{-- Gambar dan Kalimat 3 --}}
        <div class="row text-center my-4">
            <div class="col-md-6 mb-3">
                <img src="{{ asset('images/materi/bekantan-big.png') }}" class="img-fluid rounded shadow" alt="Penggaris Panjang">
                <p class="mt-2 fw-semibold">
                    Patung Bekantan memiliki bentuk yang tinggi.
                    <button onclick="toggleAudio(this)" 
                            class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2"
                            data-id="index-5" data-playing="false">🔊</button>
                    <audio id="audio-index-5" src="{{ asset('sounds/materi/hal3/5.mp3') }}"></audio>
                </p>
            </div>
            <div class="col-md-6 mb-3">
                <img src="{{ asset('images/materi/bekantan-mini.png') }}" class="img-fluid rounded shadow" alt="Penggaris Pendek">
                <p class="mt-2 fw-semibold">
                    Miniatur Bekantan memiliki bentuk yang rendah.
                    <button onclick="toggleAudio(this)" 
                            class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2"
                            data-id="index-6" data-playing="false">🔊</button>
                    <audio id="audio-index-6" src="{{ asset('sounds/materi/hal3/6.mp3') }}"></audio>
                </p>
            </div>
        </div>

        {{-- Dua Paragraf --}}
        <div class="mt-2">
            <p>
                Ukuran panjang dan pendek digunakan untuk membandingkan jarak dari ujung ke ujung suatu benda. Benda dengan jarak yang lebih jauh disebut panjang, sedangkan benda dengan jarak lebih dekat disebut pendek.
                <button onclick="toggleAudio(this)" 
                        class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2"
                        data-id="index-7" data-playing="false">🔊</button>
                <audio id="audio-index-7" src="{{ asset('sounds/materi/hal3/7.mp3') }}"></audio>
            </p>
            <p>
                Tinggi dan rendah adalah ukuran yang digunakan untuk membandingkan ketinggian suatu benda dari dasar ke atas. Benda yang memiliki jarak vertikal lebih jauh disebut tinggi, sedangkan benda dengan jarak vertikal lebih dekat disebut rendah.
                <button onclick="toggleAudio(this)" 
                        class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2"
                        data-id="index-8" data-playing="false">🔊</button>
                <audio id="audio-index-8" src="{{ asset('sounds/materi/hal3/8.mp3') }}"></audio>
            </p>
        </div>

    </div>

    <div class="card-footer d-flex justify-content-between">
        <a href="{{ route('admin.materi.halaman2') }}" class="btn bg-coklap2 text-white">← Sebelumnya</a>
        <a href="{{ route('admin.materi.halaman4') }}" class="btn bg-coklap1 text-white">Selanjutnya →</a>
    </div>
</div>
<br>
@endsection

@section('scripts')
<script>
    let currentAudio = null;
    let currentButton = null;

    function toggleAudio(button) {
        const id = button.getAttribute('data-id');
        const audio = document.getElementById(`audio-${id}`);

        // Pause semua audio lain
        document.querySelectorAll('audio').forEach(a => {
            if (a !== audio) {
                a.pause();
                a.currentTime = 0;
            }
        });

        // Reset semua tombol ke 🔊
        document.querySelectorAll('button[data-id]').forEach(btn => {
            if (btn !== button) {
                btn.innerText = '🔊';
                btn.setAttribute('data-playing', 'false');
            }
        });

        // Toggle play/pause
        if (audio.paused) {
            audio.play();
            button.innerText = '⏸️';
            button.setAttribute('data-playing', 'true');
            currentAudio = audio;
            currentButton = button;
        } else {
            audio.pause();
            button.innerText = '🔊';
            button.setAttribute('data-playing', 'false');
        }

        // Auto-reset ikon saat audio selesai
        audio.onended = function () {
            button.innerText = '🔊';
            button.setAttribute('data-playing', 'false');
        };
    }
</script>
@endsection