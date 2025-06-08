@extends('layouts.master')

@section('content')

    <div class="card bg-coklat">
        <div class="card-header">
            <h4 class="mb-0 fs-5">
                Pengukuran
            </h4>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item bg-transparent border-dark">
                    <h5 class="fw-bold  fs-5">
                        Membandingkan dan Mengurutkan Panjang Benda
                        <button onclick="toggleAudio(this)" 
                                class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2"
                                data-id="index-1" data-playing="false">🔊</button>
                        <audio id="audio-index-1" src="{{ asset('sounds/materi/hal2/1.mp3') }}"></audio>
                    </h5>

                    <h6 class="fw-bold mt-3  fs-5">
                        Tujuan Pembelajaran
                        <button onclick="toggleAudio(this)" 
                                class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2"
                                data-id="index-2" data-playing="false">🔊</button>
                        <audio id="audio-index-2" src="{{ asset('sounds/materi/hal2/2.mp3') }}"></audio>
                    </h6>

                    <p class="mt-2 fs-5">
                        Setelah mempelajari materi ini, diharapkan peserta didik dapat:<br>
                        1. Membandingkan panjang benda;<br>
                        2. Mengurutkan benda berdasarkan panjangnya.
                    </p>
                </li>

                <li class="list-group-item bg-transparent">
                    <h6 class="fw-bold  fs-5">
                        Ayo Belajar
                        <button onclick="toggleAudio(this)" 
                                class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2"
                                data-id="index-3" data-playing="false">🔊</button>
                        <audio id="audio-index-3" src="{{ asset('sounds/materi/hal2/3.mp3') }}"></audio>
                    </h6>

                    <p class="mt-2 fs-5">
                        Pengukuran adalah cara untuk mengetahui seberapa besar, panjang, atau tinggi suatu benda. Dengan pengukuran, kita dapat membandingkan benda-benda di sekitar kita. Perhatikan contoh berikut.
                    </p>
                </li>
            </ul>

            {{-- Gambar --}}
            <div class="row text-center my-4">
                <div class="col-md-6 mb-3">
                    <img src="{{ asset('images/materi/baju-sasi-pendek.png') }}" class="img-fluid rounded shadow" alt="Gambar Penggaris">
                    <p class="mt-2 fs-5 fw-semibold">
                        baju pengantin banjar lengan pendek
                        <button onclick="toggleAudio(this)" 
                                class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2"
                                data-id="index-4" data-playing="false">🔊</button>
                        <audio id="audio-index-4" src="{{ asset('sounds/materi/hal2/4.mp3') }}"></audio>
                        <audio id="audio-hal2-4" src="{{ asset('sounds/materi/hal2/4.mp3') }}"></audio>
                    </p>
                </div>
                <div class="col-md-6 mb-3">
                    <img src="{{ asset('images/materi/baju-sasi-panjang.svg') }}" class="img-fluid rounded shadow" alt="Gambar Pensil" style="width: 313px; height: 313px;">
                    <p class="mt-2 fs-5 fw-semibold">
                        baju pengantin banjar lengan panjang
                        <button onclick="toggleAudio(this)" 
                                class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2"
                                data-id="index-5" data-playing="false">🔊</button>
                        <audio id="audio-index-5" src="{{ asset('sounds/materi/hal2/5.mp3') }}"></audio>
                    </p>
                </div>
            </div>
        </div>

        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('admin.materi.index') }}" class="btn bg-coklap2 text-white fs-5">← Sebelumnya</a>
            <a href="{{ route('admin.materi.halaman3') }}" class="btn bg-coklap1 text-white fs-5">Selanjutnya →</a>
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