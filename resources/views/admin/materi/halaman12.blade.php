@extends('layouts.master')

@section('content')

<div class="card bg-coklat">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Pengukuran</h4>
    </div>
    <div class="card-body">

        <p class="fw-semibold mb-3">Beberapa alat ukur tidak baku yang digunakan dalam kehidupan sehari-hari:
            <button onclick="toggleAudio(this)" 
                    class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2"
                    data-id="index-1" data-playing="false">🔊</button>
            <audio id="audio-index-1" src="{{ asset('sounds/materi/hal12/1.mp3') }}"></audio>
        </p>

        {{-- Grid Gambar --}}
        <div class="container text-center">
            <div class="row mb-4">
                <div class="col-3">
                    <img src="{{ asset('images/materi/jengkal.png') }}" class="img-fluid shadow mb-2" style="max-height: 100px;" alt="Jengkal">
                    <p class="fw-semibold">jengkal
                        <button onclick="toggleAudio(this)" 
                                class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2"
                                data-id="index-2" data-playing="false">🔊</button>
                        <audio id="audio-index-2" src="{{ asset('sounds/materi/hal12/2.mp3') }}"></audio>
                    </p>
                </div>
                <div class="col-3">
                    <img src="{{ asset('images/materi/hasta.png') }}" class="img-fluid shadow mb-2" style="max-height: 100px;" alt="Hasta">
                    <p class="fw-semibold">hasta
                        <button onclick="toggleAudio(this)" 
                                class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2"
                                data-id="index-3" data-playing="false">🔊</button>
                        <audio id="audio-index-3" src="{{ asset('sounds/materi/hal12/3.mp3') }}"></audio>
                    </p>
                </div>
                <div class="col-3">
                    <img src="{{ asset('images/materi/depa.png') }}" class="img-fluid shadow mb-2" style="max-height: 100px;" alt="Depa">
                    <p class="fw-semibold">depa
                        <button onclick="toggleAudio(this)" 
                                class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2"
                                data-id="index-4" data-playing="false">🔊</button>
                        <audio id="audio-index-4" src="{{ asset('sounds/materi/hal12/4.mp3') }}"></audio>
                    </p>
                </div>
                <div class="col-3">
                    <img src="{{ asset('images/materi/telapak-kaki.png') }}" class="img-fluid shadow mb-2" style="max-height: 100px;" alt="Telapak Kaki">
                    <p class="fw-semibold">telapak kaki
                        <button onclick="toggleAudio(this)" 
                                class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2"
                                data-id="index-5" data-playing="false">🔊</button>
                        <audio id="audio-index-5" src="{{ asset('sounds/materi/hal12/5.mp3') }}"></audio>
                    </p>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-3">
                    <img src="{{ asset('images/materi/koin.png') }}" class="img-fluid shadow mb-2" style="max-height: 100px;" alt="Koin">
                    <p class="fw-semibold">koin
                        <button onclick="toggleAudio(this)" 
                                class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2"
                                data-id="index-6" data-playing="false">🔊</button>
                        <audio id="audio-index-6" src="{{ asset('sounds/materi/hal12/6.mp3') }}"></audio>
                    </p>
                </div>
                <div class="col-3">
                    <img src="{{ asset('images/materi/sedotan.png') }}" class="img-fluid shadow mb-2" style="max-height: 100px;" alt="Sedotan">
                    <p class="fw-semibold">sedotan
                        <button onclick="toggleAudio(this)" 
                                class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2"
                                data-id="index-7" data-playing="false">🔊</button>
                        <audio id="audio-index-7" src="{{ asset('sounds/materi/hal12/7.mp3') }}"></audio>
                    </p>
                </div>
                <div class="col-3">
                    <img src="{{ asset('images/materi/klip-kertas.png') }}" class="img-fluid shadow mb-2" style="max-height: 100px;" alt="Klip Kertas">
                    <p class="fw-semibold">klip kertas
                        <button onclick="toggleAudio(this)" 
                                class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2"
                                data-id="index-8" data-playing="false">🔊</button>
                        <audio id="audio-index-8" src="{{ asset('sounds/materi/hal12/8.mp3') }}"></audio>
                    </p>
                </div>
                <div class="col-3">
                    <img src="{{ asset('images/materi/stik-eskrim.png') }}" class="img-fluid shadow mb-2" style="max-height: 100px;" alt="Stik Es Krim">
                    <p class="fw-semibold">stik eskrim
                        <button onclick="toggleAudio(this)" 
                                class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2"
                                data-id="index-9" data-playing="false">🔊</button>
                        <audio id="audio-index-9" src="{{ asset('sounds/materi/hal12/9.mp3') }}"></audio>
                    </p>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <button onclick="toggleAudio(this)" 
                    class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2"
                    data-id="index-10" data-playing="false">🔊</button>
            <audio id="audio-index-10" src="{{ asset('sounds/materi/hal12/10.mp3') }}"></audio>
            <p><strong>Kalian bisa menggunakan benda lain di sekitar.</strong></p>
            <p><strong>Penjelasan:</strong></p>
            <ul>
                <li>Jengkal adalah menggunakan jari tangan.</li>
                <li>Hasta adalah jarak antara ujung jari tengah ke siku tangan.</li>
                <li>Depa adalah merentangkan kedua tangan.</li>
                <li>Telapak kaki adalah jumlah langkah kaki.</li>
            </ul>
        </div>

    </div>

    <div class="card-footer d-flex justify-content-between">
        <a href="{{ route('admin.materi.halaman11') }}" class="btn bg-coklap2 text-white">← Sebelumnya</a>
        <a href="{{ route('admin.materi.halaman13') }}" class="btn bg-coklap1 text-white">Selanjutnya →</a>
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
