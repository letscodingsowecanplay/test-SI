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
                        <button onclick="toggleAudio(this)" 
                                class="btn btn-sm btn-outline-dark bg-coklapbet text-white"
                                data-id="index-1" data-playing="false">🔊</button>
                        <audio id="audio-index-1" src="{{ asset('sounds/materi/hal14/1.mp3') }}"></audio><br>
                        Kemungkinan Perbedaan Pengukuran pada Suatu Benda dengan Satuan Tidak Baku.
                    </p>
                    <p class="mt-2">
                        Ketika kita mengukur suatu benda menggunakan satuan tidak baku, hasilnya bisa berbeda tergantung pada alat atau benda yang digunakan sebagai satuan ukur. Hal ini terjadi karena satuan tidak baku tidak memiliki ukuran yang tetap seperti satuan baku (misalnya meter atau sentimeter).
                    </p>
                    <p class="mt-2">
                        Sebagai contoh, jika kita mengukur tinggi sebuah buku menggunakan stik es krim, hasilnya mungkin 3 stik es krim. Namun, jika kita mengukurnya dengan pensil, hasilnya bisa berbeda, misalnya 2 pensil. Hal ini terjadi karena panjang stik es krim dan pensil tidak sama—stik es krim lebih pendek dibandingkan pensil, sehingga diperlukan lebih banyak stik es krim untuk mengukur tinggi buku tersebut.
                    </p>
                    <p class="mt-2">
                        Perbedaan pengukuran ini menunjukkan bahwa satuan tidak baku bersifat relatif dan bisa berubah tergantung pada benda yang digunakan untuk mengukur.
                    </p>
                </li>
            </ul>

            {{-- Gambar --}}
            <div class="row text-center my-4">
                <div class="d-flex justify-content-center my-4">
                    <img src="{{ asset('images/materi/perbedaan-hasil-ukur.png') }}" 
                         alt="Gambar Perbedaan Pengukuran" 
                         class="rounded shadow" 
                         style="display: block; margin: 0 auto; width: 300px; height: 300px; object-fit: cover;">
                </div>

                {{-- Caption dengan audio --}}
                <div class="text-center mt-2">
                    <p class="mt-2">
                        Panjang buku adalah 3 stik es krim.<br>
                        Panjang buku adalah 2 pensil.
                        <button onclick="toggleAudio(this)" 
                                class="btn btn-sm btn-outline-dark bg-coklapbet text-white"
                                data-id="index-2" data-playing="false">🔊</button>
                        <audio id="audio-index-2" src="{{ asset('sounds/materi/hal14/2.mp3') }}"></audio>
                    </p>
                </div>
            </div>
        </div>

        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('admin.materi.halaman13') }}" class="btn bg-coklap2 text-white fs-5">← Sebelumnya</a>
            <a href="{{ route('admin.materi.halaman15') }}" class="btn bg-coklap1 text-white fs-5">Selanjutnya →</a>
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

        // Reset ikon saat audio selesai
        audio.onended = function () {
            button.innerText = '🔊';
            button.setAttribute('data-playing', 'false');
        };
    }
</script>
@endsection
