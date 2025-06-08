@extends('layouts.master')
@section('content')
<div class="alert alert-warning mb-3 fs-5">
    <b>Petunjuk:</b> Kalau kamu ingin mendengar kalimatnya, tekan tombol 
    <span style="font-size:1.2em;">🔊</span> yang ada di sebelah tulisan. 
    Nanti akan ada suara yang membacakan materi untukmu! 
    <button onclick="toggleAudio(this)" 
            class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2 fs-5"
            data-id="index-0" data-playing="false">🔊</button>
    <audio id="audio-index-0" src="{{ asset('sounds/materi/index/0.mp3') }}"></audio>
</div>
<div class="card bg-coklat">
    <div class="card-header">
        <h4 class="mb-0 fs-5">Materi Pengukuran</h4>
    </div>
    <div class="card-body">
        <ul class="list-group list-group-flush">
            <li class="list-group-item bg-transparent border-dark">
                <h5 class="fw-bold mb-0 fs-5">
                    SubBab 1: Membandingkan dan Mengurutkan Panjang Benda
                    <button onclick="toggleAudio(this)" 
                            class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2 fs-5"
                            data-id="index-1" data-playing="false">🔊</button>
                    <audio id="audio-index-1" src="{{ asset('sounds/materi/index/1.mp3') }}"></audio>
                </h5>
                <p class="mt-2 fs-5">
                    Setelah mempelajari materi ini, diharapkan peserta didik dapat membandingkan panjang dua benda dan mengurutkan benda berdasarkan panjangnya.
                    <button onclick="toggleAudio(this)" 
                            class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2 fs-5"
                            data-id="index-2" data-playing="false">🔊</button>
                    <audio id="audio-index-2" src="{{ asset('sounds/materi/index/2.mp3') }}"></audio>
                </p>
            </li>
            <li class="list-group-item bg-transparent border-dark">
                <h5 class="fw-bold mb-0 fs-5">
                    SubBab 2: Mengukur Panjang Benda
                    <button onclick="toggleAudio(this)" 
                            class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2 fs-5"
                            data-id="index-3" data-playing="false">🔊</button>
                    <audio id="audio-index-3" src="{{ asset('sounds/materi/index/3.mp3') }}"></audio>
                </h5>
                <p class="mt-2 fs-5">
                    Setelah mempelajari materi ini, diharapkan peserta didik dapat memperkirakan panjang benda dengan menggunakan satuan tidak baku dan mengukur panjang benda dengan memanfaatkan objek lain sebagai satuan tidak baku.
                    <button onclick="toggleAudio(this)" 
                            class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2 fs-5"
                            data-id="index-4" data-playing="false">🔊</button>
                    <audio id="audio-index-4" src="{{ asset('sounds/materi/index/4.mp3') }}"></audio>
                </p>
            </li>
        </ul>
    </div>
    <div class="card-footer text-end">
        <a href="{{ route('admin.materi.halaman2') }}" class="btn bg-coklap1 text-white fs-5">Selanjutnya →</a>
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
        document.querySelectorAll('audio').forEach(a => {
            if (a !== audio) { a.pause(); a.currentTime = 0; }
        });
        document.querySelectorAll('button[data-id]').forEach(btn => {
            if (btn !== button) {
                btn.innerText = '🔊'; btn.setAttribute('data-playing', 'false');
            }
        });
        if (audio.paused) {
            audio.play();
            button.innerText = '⏸️';
            button.setAttribute('data-playing', 'true');
            currentAudio = audio; currentButton = button;
        } else {
            audio.pause();
            button.innerText = '🔊';
            button.setAttribute('data-playing', 'false');
        }
        audio.onended = function () {
            button.innerText = '🔊';
            button.setAttribute('data-playing', 'false');
        };
    }
</script>
@endsection
