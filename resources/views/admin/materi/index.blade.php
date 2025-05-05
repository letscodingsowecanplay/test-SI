@extends('layouts.master')

@section('content')
    <div class="card bg-coklat">
        <div class="card-header">
            <h4 class="mb-0">Materi Pengukuran</h4>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item bg-transparent border-dark">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0">SubBab 1: Membandingkan dan Mengurutkan Panjang Benda</h5>
                        <button onclick="playSound('subbab1')" class="btn btn-sm btn-outline-dark bg-coklapbet text-white">🔊</button>
                        <audio id="audio-subbab1" src="{{ asset('sounds/materi/subbab1.mp3') }}"></audio>
                    </div>
                    <div class="d-flex justify-content-between align-items-start mt-2">
                        <p>Peserta didik dapat membandingkan panjang dan mengukur menggunakan satuan tidak baku.
                        <button onclick="playSound('paragraf1')" class="btn btn-sm btn-outline-dark bg-coklapbet text-white mt-1">🔊</button>
                        <audio id="audio-paragraf1" src="{{ asset('sounds/materi/paragraf1.mp3') }}"></audio></p>
                    </div>
                </li>

                <li class="list-group-item bg-transparent">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0">SubBab 2: Mengukur Panjang Benda</h5>
                        <button onclick="playSound('subbab2')" class="btn btn-sm btn-outline-dark bg-coklapbet text-white">🔊</button>
                        <audio id="audio-subbab2" src="{{ asset('sounds/materi/subbab2.mp3') }}"></audio>
                    </div>
                    <div class="d-flex justify-content-between align-items-start mt-2">
                        <p>Peserta didik mengenali benda ringan dan berat serta cara mengukurnya secara sederhana.
                        <button onclick="playSound('paragraf2')" class="btn btn-sm btn-outline-dark bg-coklapbet text-white mt-1">🔊</button>
                        <audio id="audio-paragraf2" src="{{ asset('sounds/materi/paragraf2.mp3') }}"></audio></p>
                    </div>
                </li>
            </ul>
        </div>
        <div class="card-footer text-end">
            <a href="{{ route('admin.materi.halaman2') }}" class="btn btn-primary">Next Halaman →</a>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    function playSound(id) {
        // Hentikan semua audio dulu
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
