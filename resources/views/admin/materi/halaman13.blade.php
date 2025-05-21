@extends('layouts.master')

@section('content')

<div class="card bg-coklat">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Alat Ukur Tidak Baku</h4>
    </div>
    <div class="card-body">
    <button onclick="playSound('ayo-belajar')" class="btn btn-sm btn-outline-dark bg-coklapbet text-white" title="Dengarkan">
        🔊
    </button>
    <audio id="audio-ayo-belajar" src="{{ asset('sounds/materi/ayo-belajar.mp3') }}"></audio>
        <div class="mt-4">
            <p>Mengukur panjang benda menggunakan satuan tidak baku dapat dilakukan dengan beberapa langkah sederhana. Perhatikan contoh berikut.<br><br>

            Cara mengukur yang benar:<br>
            1. Mulai dari ujung benda.<br>
            2. Alat ukur rapat.<br>
            3. Alat ukur tidak bertumpuk.<br>
            4. Alat ukur tidak miring.</p><br>
        </div>

        {{-- Grid Gambar --}}
        <div class="container text-center">
            <div class="row mb-4">
                <div class="col-3">
                    <img src="{{ asset('images/materi/ukur-salah-1.png') }}" class="img-fluid shadow mb-2" style="max-height: 300px;" alt="Jengkal">
                </div>
                <div class="col-3">
                </div>
                <div class="col-3">
                    <img src="{{ asset('images/materi/ukur-benar.png') }}" class="img-fluid shadow mb-2" style="max-height: 300px;" alt="Hasta">
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-3">
                    <img src="{{ asset('images/materi/ukur-salah-2.png') }}" class="img-fluid shadow mb-2" style="max-height: 300px;" alt="Koin">
                </div>
                <div class="col-3">
                </div>
                <div class="col-3">
                    <img src="{{ asset('images/materi/ukur-salah-3.png') }}" class="img-fluid shadow mb-2" style="max-height: 300px;" alt="Sedotan">
                </div>
            </div>
        </div>

    </div>

    <div class="card-footer d-flex justify-content-between">
        <a href="{{ route('admin.materi.halaman12') }}" class="btn btn-secondary">← Sebelumnya</a>
        <a href="{{ route('admin.materi.halaman14') }}" class="btn btn-primary">Selanjutnya →</a>
    </div>
</div>
<br>
@endsection


@section('scripts')
<script>
    function playSound(id) {
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
