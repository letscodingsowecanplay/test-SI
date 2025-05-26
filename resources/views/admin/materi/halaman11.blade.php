@extends('layouts.master')

@section('content')

    <div class="card bg-coklat">
        <div class="card-header">
            <h4 class="mb-0">
                Pengukuran
            </h4>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item bg-transparent border-dark">
                    <h5 class="fw-bold mb-0">
                        Mengukur Panjang Benda
                        <button onclick="toggleAudio(this)" 
                                class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2"
                                data-id="index-1" data-playing="false">🔊</button>
                        <audio id="audio-index-1" src="{{ asset('sounds/materi/hal11/1.mp3') }}"></audio>
                    </h5>

                    <h6 class="fw-bold mt-3 mb-0">
                        Tujuan Pembelajaran
                        <button onclick="toggleAudio(this)" 
                                class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2"
                                data-id="index-2" data-playing="false">🔊</button>
                        <audio id="audio-index-2" src="{{ asset('sounds/materi/hal11/2.mp3') }}"></audio>
                    </h6>

                    <p class="mt-2">
                        Setelah mempelajari materi ini, diharapkan peserta didik dapat:<br>
                        1. Memperkirakan panjang benda dengan menggunakan satuan tidak baku;<br>
                        2. Mengukur panjang benda dengan memanfaatkan objek lain sebagai satuan tidak baku.
                    </p>
                </li>

                <li class="list-group-item bg-transparent">
                    <h6 class="fw-bold mb-0">
                        Ayo Belajar
                        <button onclick="toggleAudio(this)" 
                                class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2"
                                data-id="index-3" data-playing="false">🔊</button>
                        <audio id="audio-index-3" src="{{ asset('sounds/materi/hal11/3.mp3') }}"></audio>
                    </h6>

                    <p class="mt-2">
                        Kita dapat membandingkan panjang suatu benda dengan dua metode, yaitu secara langsung dan tidak langsung.<br>
                        Apa perbedaannya?
                    </p>

                    <p class="mt-2">
                        Berdirilah sejajar dengan dua temanmu. Siapa yang paling tinggi dan siapa yang paling pendek? <br>
                        Cara membandingkan seperti ini disebut membandingkan secara langsung, karena tidak memerlukan alat ukur.
                    </p>

                    <p class="mt-2">
                        Lalu, bagaimana caranya membandingkan panjang kain sasirangan milikmu dengan panjang kain sasirangan milik temanmu yang lokasinya berjauhan?
                    </p>

                    <p class="mt-2">
                        Tentunya, kamu harus mengukur panjang kain sasiranganmu, lalu mengukur panjang kain sasirangan temanmu. Setelah itu, hasil pengukuran dapat dibandingkan untuk mengetahui mana yang lebih panjang.
                    </p>

                    <p class="mt-2">
                        Metode ini disebut membandingkan secara tidak langsung, karena memerlukan alat ukur.
                    </p>
                </li>
            </ul>
        </div>

        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('admin.materi.halaman10') }}" class="btn bg-coklap2 text-white">← Sebelumnya</a>
            <a href="{{ route('admin.materi.halaman12') }}" class="btn bg-coklap1 text-white">Selanjutnya →</a>
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