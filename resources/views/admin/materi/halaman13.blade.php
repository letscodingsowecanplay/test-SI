@extends('layouts.master')

@section('content')

<div class="card bg-coklat fs-5">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Pengukuran</h4>
    </div>
    <div class="card-body">
        <button onclick="toggleAudio(this)" 
                class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2"
                data-id="index-1" data-playing="false">🔊</button>
        <audio id="audio-index-1" src="{{ asset('sounds/materi/hal13/1.mp3') }}"></audio>
        <div class="mt-4">
            <p>Mengukur panjang benda menggunakan satuan tidak baku dapat dilakukan dengan beberapa langkah sederhana.<br><br>

            Cara mengukur yang benar:<br>
            1. Mulai dari ujung benda.<br>
            2. Alat ukur rapat.<br>
            3. Alat ukur tidak bertumpuk.<br>
            4. Alat ukur tidak miring.<br><br>

            Perhatikan contoh berikut.<br>

            Gambar di bawah ini menunjukkan cara mengukur panjang ikan papuyu dengan menggunakan sedotan sebagai alat ukurnya.
            </p><br>
        </div>

        {{-- Grid Gambar --}}
        <div class="container text-center">
            <div class="row mb-4">
                <div class="col-3">
                    <img src="{{ asset('images/materi/ukur-salah-1.png') }}"
                    class="img-fluid shadow mb-2"
                    style="max-height: 300px; cursor: pointer;"
                    alt="Alat ukur diletakkan renggang, tidak rapat pada ujung benda."
                    data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    title="Alat ukur diletakkan renggang, tidak rapat pada ujung benda." />
                </div>
                <div class="col-3">
                </div>
                <div class="col-3">
                    <img src="{{ asset('images/materi/ukur-benar.png') }}"
                    class="img-fluid shadow mb-2"
                    style="max-height: 300px; cursor: pointer;"
                    alt="Alat ukur diletakkan rapat dan dimulai dari ujung benda dengan benar."
                    data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    title="Alat ukur diletakkan rapat dan dimulai dari ujung benda dengan benar." />
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-3">
                    <img src="{{ asset('images/materi/ukur-salah-2.png') }}"
                    class="img-fluid shadow mb-2"
                    style="max-height: 300px; cursor: pointer;"
                    alt="Alat ukur diletakkan dalam posisi miring, tidak lurus."
                    data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    title="Alat ukur diletakkan dalam posisi miring, tidak lurus." />
                </div>
                <div class="col-3">
                </div>
                <div class="col-3">
                    <img src="{{ asset('images/materi/ukur-salah-3.png') }}"
                    class="img-fluid shadow mb-2"
                    style="max-height: 300px; cursor: pointer;"
                    alt="Alat ukur bertumpuk, tidak diletakkan secara sejajar."
                    data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    title="Alat ukur bertumpuk, tidak diletakkan secara sejajar." />
                </div>
            </div>
        </div>

    </div>

    <div class="card-footer d-flex justify-content-between">
        <a href="{{ route('admin.materi.halaman12') }}" class="btn bg-coklap2 text-white fs-5">← Sebelumnya</a>
        <a href="{{ route('admin.materi.halaman14') }}" class="btn bg-coklap1 text-white fs-5">Selanjutnya →</a>
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

    // Inisialisasi semua elemen dengan tooltip
    document.addEventListener('DOMContentLoaded', function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.forEach(function (tooltipTriggerEl) {
            new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });

</script>
@endsection
