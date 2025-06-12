@extends('layouts.app') 

@section('content')
<div class="container py-4 fs-5">
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
                        <a href="{{ route('admin.materi.index') }}" class="btn bg-coklap1 text-white rounded-pill d-flex align-items-center justify-content-center text-white fs-5">Kembali ke Materi</a>

                        @if(count($kuisBelumSelesai) > 0)
                            <button class="btn bg-coklap2 text-white rounded-pill fs-5" disabled>Lengkapi Terlebih Dahulu</button>

                        @elseif($hasil && $hasil->status !== 'tidak_lulus')
                            <button class="btn bg-coklap2 text-white rounded-pill fs-5" disabled>Sudah Dikerjakan</button>

                        @else
                            <a href="{{ route('admin.evaluasi.index') }}" class="btn bg-coklap2 text-white rounded-pill fs-5">Mulai Evaluasi</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
    @if(count($kuisBelumSelesai) > 0)
        <div class="alert alert-warning mt-3">
            <strong>Perhatian!</strong> Kamu belum menyelesaikan bagian berikut ini:
            <ul class="mb-0">
                @foreach ($kuisBelumSelesai as $kuis)
                    <li>{{ $kuis }}</li>
                @endforeach
            </ul>
            <small>Silakan selesaikan bagian di atas terlebih dahulu sebelum memulai evaluasi.</small>
        </div>
    @endif

    @if($hasil)
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card mt-4 bg-coklat">
                <div class="card-header text-center"><strong>Hasil Evaluasi</strong></div>
                <div class="card-body">
                    <p><strong>Nilai:</strong> {{ $hasil->skor_persen }} / 100</p>
                    <p><strong>Persentase:</strong> {{ $hasil->skor_persen }}%</p>

                    @if($hasil->skor < 70)
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
