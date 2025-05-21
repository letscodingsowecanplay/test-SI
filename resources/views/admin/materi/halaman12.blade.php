@extends('layouts.master')

@section('content')

<div class="card bg-coklat">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Alat Ukur Tidak Baku</h4>
    </div>
    <div class="card-body">

        <p class="fw-semibold mb-3">Beberapa alat ukur tidak baku yang digunakan dalam kehidupan sehari-hari:
            <button onclick="playSound('ayo-belajar')" class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2" title="Dengarkan">
                🔊
            </button>
            <audio id="audio-ayo-belajar" src="{{ asset('sounds/materi/ayo-belajar.mp3') }}"></audio>
        </p>

        {{-- Grid Gambar --}}
        <div class="container text-center">
            <div class="row mb-4">
                <div class="col-3">
                    <img src="{{ asset('images/materi/jengkal.png') }}" class="img-fluid shadow mb-2" style="max-height: 100px;" alt="Jengkal">
                    <p class="fw-semibold">jengkal
                        <button onclick="playSound('ayo-belajar')" class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2" title="Dengarkan">
                            🔊
                        </button>
                        <audio id="audio-ayo-belajar" src="{{ asset('sounds/materi/ayo-belajar.mp3') }}"></audio>
                    </p>
                </div>
                <div class="col-3">
                    <img src="{{ asset('images/materi/hasta.png') }}" class="img-fluid shadow mb-2" style="max-height: 100px;" alt="Hasta">
                    <p class="fw-semibold">hasta
                        <button onclick="playSound('ayo-belajar')" class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2" title="Dengarkan">
                            🔊
                        </button>
                        <audio id="audio-ayo-belajar" src="{{ asset('sounds/materi/ayo-belajar.mp3') }}"></audio></p>
                </div>
                <div class="col-3">
                    <img src="{{ asset('images/materi/depa.png') }}" class="img-fluid shadow mb-2" style="max-height: 100px;" alt="Depa">
                    <p class="fw-semibold">depa
                        <button onclick="playSound('ayo-belajar')" class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2" title="Dengarkan">
                            🔊
                        </button>
                        <audio id="audio-ayo-belajar" src="{{ asset('sounds/materi/ayo-belajar.mp3') }}"></audio></p>
                </div>
                <div class="col-3">
                    <img src="{{ asset('images/materi/telapak-kaki.png') }}" class="img-fluid shadow mb-2" style="max-height: 100px;" alt="Telapak Kaki">
                    <p class="fw-semibold">telapak kaki
                        <button onclick="playSound('ayo-belajar')" class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2" title="Dengarkan">
                            🔊
                        </button>
                        <audio id="audio-ayo-belajar" src="{{ asset('sounds/materi/ayo-belajar.mp3') }}"></audio></p>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-3">
                    <img src="{{ asset('images/materi/koin.png') }}" class="img-fluid shadow mb-2" style="max-height: 100px;" alt="Koin">
                    <p class="fw-semibold">koin
                        <button onclick="playSound('ayo-belajar')" class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2" title="Dengarkan">
                            🔊
                        </button>
                        <audio id="audio-ayo-belajar" src="{{ asset('sounds/materi/ayo-belajar.mp3') }}"></audio></p>
                </div>
                <div class="col-3">
                    <img src="{{ asset('images/materi/sedotan.png') }}" class="img-fluid shadow mb-2" style="max-height: 100px;" alt="Sedotan">
                    <p class="fw-semibold">sedotan
                        <button onclick="playSound('ayo-belajar')" class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2" title="Dengarkan">
                            🔊
                        </button>
                        <audio id="audio-ayo-belajar" src="{{ asset('sounds/materi/ayo-belajar.mp3') }}"></audio></p>
                </div>
                <div class="col-3">
                    <img src="{{ asset('images/materi/klip-kertas.png') }}" class="img-fluid shadow mb-2" style="max-height: 100px;" alt="Klip Kertas">
                    <p class="fw-semibold">klip kertas
                        <button onclick="playSound('ayo-belajar')" class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2" title="Dengarkan">
                            🔊
                        </button>
                        <audio id="audio-ayo-belajar" src="{{ asset('sounds/materi/ayo-belajar.mp3') }}"></audio></p>
                </div>
                <div class="col-3">
                    <img src="{{ asset('images/materi/stik-eskrim.png') }}" class="img-fluid shadow mb-2" style="max-height: 100px;" alt="Stik Es Krim">
                    <p class="fw-semibold">stik eskrim
                        <button onclick="playSound('ayo-belajar')" class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2" title="Dengarkan">
                            🔊
                        </button>
                        <audio id="audio-ayo-belajar" src="{{ asset('sounds/materi/ayo-belajar.mp3') }}"></audio></p>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <button onclick="playSound('ayo-belajar')" class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2" title="Dengarkan">
                🔊
            </button>
            <audio id="audio-ayo-belajar" src="{{ asset('sounds/materi/ayo-belajar.mp3') }}"></audio>
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
        <a href="{{ route('admin.materi.halaman11') }}" class="btn btn-secondary">← Sebelumnya</a>
        <a href="{{ route('admin.materi.halaman13') }}" class="btn btn-primary">Selanjutnya →</a>
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
