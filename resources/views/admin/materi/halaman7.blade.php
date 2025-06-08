@extends('layouts.master')

@section('content')

    <div class="card bg-coklat fs-5">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Pengukuran</h4>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                

                <li class="list-group-item bg-transparent">

                    <p class="mt-2">
                        Kita bandingkan lukisan a, b, c, dan d.
                        <button onclick="toggleAudio(this)" 
                                class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2"
                                data-id="index-1" data-playing="false">🔊</button>
                        <audio id="audio-index-1" src="{{ asset('sounds/materi/hal7/1.mp3') }}"></audio>
                    </p>
                </li>
            </ul>

            {{-- Gambar --}}
            <div class="row text-center my-4">
                <div class="d-flex justify-content-center my-4">
                    <img src="{{ asset('images/materi/susunan-foto-banjar.png') }}" 
                    alt="Gambar Penggaris" 
                    class="rounded shadow" 
                    style="display: block; margin: 0 auto; width: 600px; height: 300px; object-fit: cover;">
                </div>
            </div>

            <ul class="list-group list-group-flush">
                

                <li class="list-group-item bg-transparent">
                    <button onclick="toggleAudio(this)" 
                            class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2"
                            data-id="index-1" data-playing="false">🔊</button>
                    <audio id="audio-index-1" src="{{ asset('sounds/materi/hal7/1.mp3') }}"></audio>
                    <p class="mt-2">
                        Lukisan a lebih tinggi dari lukisan b, c, dan d.<br>
                        Jadi, lukisan a paling tinggi.
                    </p>

                    <p class="mt-2">
                        Lukisan d lebih rendah dari lukisan c, b, dan a.<br>
                        Jadi, lukisan d paling rendah.
                    </p>
                    <p class="mt-2">
                        Kita dapat membandingkan tinggi tiga benda atau lebih.<br>
                        Kita menggunakan kata:<br>
                        • paling tinggi<br>
                        • paling rendah
                    </p>
                    <p class="mt-2">
                        Mengurutkan panjang, pendek, tinggi, dan rendah adalah proses menyusun benda-benda berdasarkan ukurannya, baik dari segi jarak maupun ketinggian. Dalam pengurutan ini, kita bisa mulai dari yang paling kecil hingga yang paling besar atau sebaliknya, tergantung kebutuhan. Benda yang lebih panjang atau lebih tinggi ditempatkan di salah satu ujung urutan, sementara yang lebih pendek atau lebih rendah berada di ujung lainnya. 
                    </p>
                    <p class="mt-2">
                        Urutan lukisan dari yang paling tinggi adalah a, b, c, dan d
                        atau a, c, b, dan d.<br>
                        Urutan lukisan dari yang paling rendah adalah d, c, b, dan a
                        atau d, b, c, dan a.
                    </p>
                </li>
            </ul>

        </div>

        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('admin.materi.halaman6') }}" class="btn bg-coklap2 text-white fs-5">← Sebelumnya</a>
            <a href="{{ route('admin.materi.halaman8') }}" class="btn bg-coklap1 text-white fs-5">Selanjutnya →</a>
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
