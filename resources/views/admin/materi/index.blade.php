@extends('layouts.master')

@section('content')
    <div class="card bg-coklat">
        <div class="card-header">
            <h4 class="mb-0">Materi Pengukuran</h4>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item bg-transparent border-dark">
                    <h5 class="fw-bold mb-0">
                        SubBab 1: Membandingkan dan Mengurutkan Panjang Benda
                        <button onclick="playSound('index-1')" class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2">🔊</button>
                        <audio id="audio-index-1" src="{{ asset('sounds/materi/index/1.mp3') }}"></audio>
                    </h5>
                    <p class="mt-2">
                        Setelah mempelajari materi ini, diharapkan peserta didik dapat membandingkan panjang dua benda dan mengurutkan benda berdasarkan panjangnya.
                        <button onclick="playSound('index-2')" class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2">🔊</button>
                        <audio id="audio-index-2" src="{{ asset('sounds/materi/index/2.mp3') }}"></audio>
                    </p>
                </li>
                <li class="list-group-item bg-transparent border-dark">
                    <h5 class="fw-bold mb-0">
                        SubBab 2: Mengukur Panjang Benda
                        <button onclick="playSound('index-3')" class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2">🔊</button>
                        <audio id="audio-index-3" src="{{ asset('sounds/materi/index/3.mp3') }}"></audio>
                    </h5>
                    <p class="mt-2">
                        Setelah mempelajari materi ini, diharapkan peserta didik dapat memperkirakan panjang benda dengan menggunakan satuan tidak baku dan mengukur panjang benda dengan memanfaatkan objek lain sebagai satuan tidak baku.
                        <button onclick="playSound('index-4')" class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2">🔊</button>
                        <audio id="audio-index-4" src="{{ asset('sounds/materi/index/4.mp3') }}"></audio>
                    </p>
                </li>
            </ul>
        </div>
        <div class="card-footer text-end">
            <a href="{{ route('admin.materi.halaman2') }}" class="btn btn-primary">Selanjutnya →</a>
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