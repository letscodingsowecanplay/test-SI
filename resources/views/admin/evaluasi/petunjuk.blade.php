@extends('layouts.app') 

@section('content')
<div class="container py-4">
    <div class="row">

        {{-- Kolom 1: Profil dan Daftar Isi --}}
        <div class="col-md-4 mb-3 ">
            <div class="card bg-coklat">
                <div class="card-header">
                    <i class="bi bi-info-circle"></i> Evaluasi
                        <button onclick="toggleAudio(this)" 
                                class="btn btn-sm btn-outline-dark bg-coklapbet text-white"
                                data-id="index-1" data-playing="false">🔊</button>
                        <audio id="audio-index-1" src="{{ asset('sounds/evaluasi/petunjuk/1.mp3') }}"></audio>
                </div>
                <div class="card-body text-center">
                    <p><strong>Pengukuran:
                    </strong></p>
                    <ol class="text-start px-3">
                        <li>Membandingkan dan Mengurutkan Panjang Benda</li>
                        <li>Mengukur Panjang Benda</li>
                    </ol>
                </div>
            </div>
        </div>

        {{-- Kolom 2: Petunjuk Kuis --}}
        <div class="col-md-4 mb-3">
            <div class="card bg-coklat">
                <div class="card-header">
                    <i class="bi bi-info-circle"></i> Petunjuk Evaluasi
                        <button onclick="toggleAudio(this)" 
                                class="btn btn-sm btn-outline-dark bg-coklapbet text-white"
                                data-id="index-2" data-playing="false">🔊</button>
                        <audio id="audio-index-2" src="{{ asset('sounds/evaluasi/petunjuk/2.mp3') }}"></audio>
                </div>
                <div class="card-body">
                    <ol class="ps-3">
                        <li>Jumlah soal dalam evaluasi ini adalah 10 butir pertanyaan.</li>
                        <li>Masing-masing soal bernilai 10 poin, jadi total skor maksimal adalah 100.</li>
                        <li>Pastikan data diri kamu sudah benar sebelum menekan tombol "Mulai Evaluasi".</li>
                        <li>Baca setiap pertanyaan dengan seksama dan pilih jawaban yang paling tepat.</li>
                        <li>Gunakan waktumu dengan bijak. Setelah selesai menjawab semua soal, klik tombol "Selesai".</li>
                        <li>Semangat dan tetap fokus! Semoga mendapatkan hasil terbaik!</li>
                    </ol>

                </div>
            </div>

            @if(session('error'))
                <div class="alert alert-warning mt-3">
                    {{ session('error') }}
                </div>
            @endif
        </div>

        {{-- Kolom 3: Data Siswa dan Tombol --}}
        <div class="col-md-4 mb-3">
            <div class="card bg-coklat">
                <div class="card-header">
                    <i class="bi bi-gear"></i> Data Siswa
                        <button onclick="toggleAudio(this)" 
                                class="btn btn-sm btn-outline-dark bg-coklapbet text-white"
                                data-id="index-3" data-playing="false">🔊</button>
                        <audio id="audio-index-3" src="{{ asset('sounds/evaluasi/petunjuk/3.mp3') }}"></audio>
                </div>
                <div class="card-body">
                    <p><strong>Nama:</strong> {{ $user->name }}</p>
                    <p><strong>Kelas:</strong> 1</p>
                    <p><strong>Sekolah:</strong> SD Banjarmasin</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>

                    <div class="d-flex justify-content-around mt-4">
                        <a href="{{ route('admin.materi.index') }}" class="btn bg-coklap1 text-white rounded-pill d-flex align-items-center justify-content-center text-white">Kembali ke Materi</a>

                        @if($bisaMulaiKuis)
                            <a href="{{ route('admin.evaluasi.index') }}" class="btn bg-coklap2 text-white rounded-pill">Mulai Evaluasi</a>
                        @else
                            <button class="btn bg-coklap2 text-white rounded-pill" disabled>Sudah Dikerjakan</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
    @if($hasil)
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card mt-4 bg-coklat">
                <div class="card-header text-center"><strong>Hasil Evaluasi <button onclick="toggleAudio(this)" 
                        class="btn btn-sm btn-outline-dark bg-coklapbet text-white"
                        data-id="index-4" data-playing="false">🔊</button>
                <audio id="audio-index-4" src="{{ asset('sounds/evaluasi/petunjuk/4.mp3') }}"></audio></strong></div>
                <div class="card-body">
                    <p><strong>Skor:</strong> {{ $hasil->skor_persen }} / 100</p>
                    <p><strong>Persentase:</strong> {{ round(($hasil->skor / $hasil->total_soal) * 100) }}%</p>

                    @if($hasil->skor < 7)
                        <p class="text-danger">Nilai Anda di bawah KKM. Silakan pelajari materi lagi dan mulai evaluasi jika sudah siap.</p>
                    @else
                        <p class="text-success">Selamat! Anda telah lulus Evaluasi ini.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

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
