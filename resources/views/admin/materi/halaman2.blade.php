@extends('layouts.master')

@section('content')

    <div class="card bg-coklat">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Pengukuran</h4>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item bg-transparent border-dark">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="fw-bold mb-0">Membandingkan dan Mengurutkan Panjang Benda</h5>
                        <button onclick="playSound('judul')" class="btn btn-sm btn-outline-dark bg-coklapbet text-white" title="Dengarkan">
                            🔊
                        </button>
                        <audio id="audio-judul" src="{{ asset('sounds/materi/judul.mp3') }}"></audio>
                    </div>

                    <div class="d-flex align-items-start justify-content-between mt-3">
                        <h6 class="fw-bold mb-0">Tujuan Pembelajaran</h6>
                        <button onclick="playSound('tujuan')" class="btn btn-sm btn-outline-dark bg-coklapbet text-white" title="Dengarkan">
                            🔊
                        </button>
                        <audio id="audio-tujuan" src="{{ asset('sounds/materi/tujuan.mp3') }}"></audio>
                    </div>

                    <p class="mt-2">
                        Setelah mempelajari materi ini, diharapkan peserta didik dapat:<br>
                        1. Membandingkan panjang benda;<br>
                        2. Mengurutkan benda berdasarkan panjangnya.
                        <button onclick="playSound('list')" class="btn btn-sm btn-outline-dark ms-2 bg-coklapbet text-white" title="Dengarkan">
                            🔊
                        </button>
                        <audio id="audio-list" src="{{ asset('sounds/materi/list.mp3') }}"></audio>
                    </p>
                </li>

                <li class="list-group-item bg-transparent">
                    <div class="d-flex align-items-start justify-content-between">
                        <h6 class="fw-bold mb-0">Ayo Belajar</h6>
                        <button onclick="playSound('ayo-belajar')" class="btn btn-sm btn-outline-dark bg-coklapbet text-white" title="Dengarkan">
                            🔊
                        </button>
                        <audio id="audio-ayo-belajar" src="{{ asset('sounds/materi/ayo-belajar.mp3') }}"></audio>
                    </div>

                    <p class="mt-2">
                        Pengukuran adalah cara untuk mengetahui seberapa besar, panjang, atau tinggi suatu benda. Dengan pengukuran, kita dapat membandingkan benda-benda di sekitar kita. Perhatikan contoh berikut.
                        <button onclick="playSound('paragraf-belajar')" class="btn btn-sm btn-outline-dark ms-2 bg-coklapbet text-white" title="Dengarkan">
                            🔊
                        </button>
                        <audio id="audio-paragraf-belajar" src="{{ asset('sounds/materi/paragraf-belajar.mp3') }}"></audio>
                    </p>
                </li>
            </ul>

            {{-- Gambar --}}
            <div class="row text-center my-4">
                <div class="col-md-6 mb-3">
                    <img src="{{ asset('images/materi/baju-sasi-pendek.png') }}" class="img-fluid rounded shadow" alt="Gambar Penggaris">
                    <p class="mt-2 fw-semibold d-flex justify-content-center align-items-center gap-2">
                        baju pengantin banjar lengan pendek
                        <button onclick="playSound('gambar1')" class="btn btn-sm btn-outline-dark bg-coklapbet text-white" title="Dengarkan kalimat ini">🔊</button>
                        <audio id="audio-gambar1" src="{{ asset('sounds/materi/gambar1.mp3') }}"></audio>
                    </p>
                </div>
                <div class="col-md-6 mb-3">
                    <img src="{{ asset('images/materi/baju-sasi-panjang.png') }}" class="img-fluid rounded shadow" alt="Gambar Pensil">
                    <p class="mt-2 fw-semibold d-flex justify-content-center align-items-center gap-2">
                        baju pengantin banjar lengan panjang
                        <button onclick="playSound('gambar2')" class="btn btn-sm btn-outline-dark bg-coklapbet text-white" title="Dengarkan kalimat ini">🔊</button>
                        <audio id="audio-gambar2" src="{{ asset('sounds/materi/gambar2.mp3') }}"></audio>
                    </p>
                </div>
            </div>

        </div>

        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('admin.materi.index') }}" class="btn btn-secondary">← Halaman 1</a>
            <a href="{{ route('admin.materi.halaman3') }}" class="btn btn-primary">Halaman 3 →</a>
        </div>
    </div>
    <br>
@endsection

@section('scripts')
<script>
    function playSound(id) {
        // pause all audio
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
