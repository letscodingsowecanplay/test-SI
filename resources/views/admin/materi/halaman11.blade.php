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
                        <button onclick="playSound('judul')" class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2" title="Dengarkan">
                            🔊
                        </button>
                        <audio id="audio-judul" src="{{ asset('sounds/materi/judul.mp3') }}"></audio>
                    </h5>

                    <h6 class="fw-bold mt-3 mb-0">
                        Tujuan Pembelajaran
                        <button onclick="playSound('tujuan')" class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2" title="Dengarkan">
                            🔊
                        </button>
                        <audio id="audio-tujuan" src="{{ asset('sounds/materi/tujuan.mp3') }}"></audio>
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
                        <button onclick="playSound('ayo-belajar')" class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2" title="Dengarkan">
                            🔊
                        </button>
                        <audio id="audio-ayo-belajar" src="{{ asset('sounds/materi/ayo-belajar.mp3') }}"></audio>
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
                        Tentunya, kamu harus mengukur panjang kain sasiranganmu, lalu mengukur panjang kain sasirangan temanmu. Setelah itu, hasil pengukuran dapat dibandingkan untuk mengetahui mana yang lebih besar.
                    </p>

                    <p class="mt-2">
                        Metode ini disebut membandingkan secara tidak langsung, karena memerlukan alat ukur.
                    </p>
                </li>
            </ul>
        </div>

        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('admin.materi.halaman10') }}" class="btn btn-secondary">← Sebelumnya</a>
            <a href="{{ route('admin.materi.halaman12') }}" class="btn btn-primary">Selanjutnya →</a>
        </div>
    </div>
    <br>
@endsection

@section('scripts')
<script>
    function playSound(id) {
        // pause all audio
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