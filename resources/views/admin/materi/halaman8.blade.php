@extends('layouts.master')

@section('content')

    <div class="card bg-coklat">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Pengukuran</h4>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                

                <li class="list-group-item bg-transparent">

                    <p class="mt-2">
                        Kita bandingkan kain sasirangan a, b, dan c.
                        <button onclick="toggleAudio(this)" 
                                class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2"
                                data-id="index-1" data-playing="false">🔊</button>
                        <audio id="audio-index-1" src="{{ asset('sounds/materi/hal8/1.mp3') }}"></audio>
                    </p>
                </li>
            </ul>

            {{-- Gambar --}}
            <div class="row text-center my-4">
                <div class="d-flex justify-content-center my-4">
                    <img src="{{ asset('images/materi/susunan-sasi.png') }}" 
                    alt="Gambar Penggaris" 
                    class="rounded shadow" 
                    style="display: block; margin: 0 auto; width: 600px; height: 300px; object-fit: cover;">
                </div>
            </div>

            <ul class="list-group list-group-flush">
                
                <li class="list-group-item bg-transparent">
                    <button onclick="toggleAudio(this)" 
                            class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2"
                            data-id="index-2" data-playing="false">🔊</button>
                    <audio id="audio-index-2" src="{{ asset('sounds/materi/hal8/2.mp3') }}"></audio>
                    <p class="mt-2">
                        Kain sasirangan a lebih pendek dari kain sasirangan b.<br>
                        kain sasirangan b lebih pendek dari kain sasirangan c.<br>
                        kain sasirangan a lebih pendek dari kain sasirangan b dan c.<br>
                        kain sasirangan a paling pendek.
                    </p>

                    <p class="mt-2">
                        Kain sasirangan c lebih panjang dari kain sasirangan b.<br>
                        kain sasirangan c lebih panjang dari kain sasirangan a.<br>
                        kain sasirangan c lebih panjang dari kain sasirangan b dan a.<br>
                        kain sasirangan c paling panjang.
                    </p>
                    <p class="mt-2">
                        Kita dapat membandingkan panjang benda.<br>
                        Kita menggunakan kata:<br>
                        • lebih panjang<br>
                        • lebih pendek<br>
                        • paling panjang<br>
                        • paling pendek
                    </p>
                    
                </li>
            </ul>

        </div>

        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('admin.materi.halaman7') }}" class="btn bg-coklap2 text-white">← Sebelumnya</a>
            <a href="{{ route('admin.materi.halaman9') }}" class="btn bg-coklap1 text-white">Selanjutnya →</a>
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
