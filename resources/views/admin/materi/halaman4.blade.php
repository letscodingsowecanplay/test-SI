@extends('layouts.master')

@section('content')
<div class="card bg-coklat">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0 fs-5">Ayo Mencoba</h4>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="mb-5 fs-5">
            <h5 class="mb-3 d-flex align-items-center">
                <strong>Contoh Soal</strong>
                <button onclick="toggleAudio(this)" 
                        class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2"
                        data-id="index-1" data-playing="false">🔊</button>
                <audio id="audio-index-1" src="{{ asset('sounds/materi/hal4/1.mp3') }}"></audio>
            </h5>
            <p>Amati gambar berikut dengan saksama!</p>
            <p>
                <strong>Pilih makanan dengan bentuk yang tinggi!</strong>
                <button onclick="toggleAudio(this)" 
                        class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2"
                        data-id="index-2" data-playing="false">🔊</button>
                <audio id="audio-index-2" src="{{ asset('sounds/materi/hal4/2.mp3') }}"></audio>
            </p>
            <div class="position-relative mx-auto mb-3" style="max-width: 600px; height: 300px;">
                <img src="{{ asset('images/materi/contoh-lat-1.png') }}" class="w-100 h-100 rounded shadow" style="object-fit: cover;">
                <div class="position-absolute" style="top: 65%; left: 25%; transform: translate(-50%, -50%);">
                    <img src="{{ asset('images/materi/contoh-lat-2.png') }}" width="120" height="120" class="shadow">
                    <div class="text-center mt-1"><span class="badge bg-light text-dark border">...</span></div>
                </div>
                <div class="position-absolute" style="top: 65%; left: 75%; transform: translate(-50%, -50%);">
                    <img src="{{ asset('images/materi/contoh-lat-3.png') }}" width="120" height="120" class="shadow">
                    <div class="text-center mt-1"><span class="badge bg-success">✔</span></div>
                </div>
            </div>
            <div class="mt-3">
                <p>
                    <strong>Penyelesaian:</strong><br>
                    Ketika kita amati kedua makanan ini, pundut di sebelah kanan memiliki bentuk yang tinggi, sedangkan nasi kuning di sebelah kiri memiliki bentuk yang rendah. Oleh karena itu, kita memilih gambar pundut.
                </p>
            </div>
        </div>
        <hr>
        <h5 class="mb-3 d-flex align-items-center fs-5">
            <strong>Ayo Mencoba</strong>
                <button onclick="toggleAudio(this)" 
                        class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2"
                        data-id="index-3" data-playing="false">🔊</button>
                <audio id="audio-index-3" src="{{ asset('sounds/materi/hal4/3.mp3') }}"></audio>
        </h5>
        <p class="fs-5">Amati gambar berikut dengan saksama!</p>

        <form id="kuisForm" action="{{ route('admin.materi.halaman4.simpan') }}" method="POST">
            @csrf

            @php
                $soalText = [
                    1 => 'Pilih iwak dengan bentuknya yang panjang!',
                    2 => 'Pilih olahan iwak wadi khas banjar dengan bentuknya yang pendek!',
                    3 => 'Pilih tempat biji-bijian khas Kalimantan berdasarkan posisi gantungnya yang tinggi!',
                    4 => 'Pilih jam dinding rotan oleh-oleh khas Kalimantan berdasarkan posisi gantungnya yang rendah!',
                ];
                $positions = [
                    1 => ['a_top' => '60%', 'a_left' => '25%', 'b_top' => '60%', 'b_left' => '75%'],
                    2 => ['a_top' => '65%', 'a_left' => '25%', 'b_top' => '65%', 'b_left' => '75%'],
                    3 => ['a_top' => '55%', 'a_left' => '25%', 'b_top' => '35%', 'b_left' => '75%'],
                    4 => ['a_top' => '55%', 'a_left' => '25%', 'b_top' => '35%', 'b_left' => '75%'],
                ];
                // Penjelasan benar/salah tiap soal
                $penjelasan = [
                    1 => [
                        'benar' => 'Jawaban kamu benar. Pilihan B adalah ikan yang bentuknya panjang.',
                        'salah' => 'Jawaban kamu salah. Yang benar adalah ikan pada pilihan B yang bentuknya panjang.',
                    ],
                    2 => [
                        'benar' => 'Jawaban kamu benar. Pilihan A adalah olahan iwak wadi yang bentuknya pendek.',
                        'salah' => 'Jawaban kamu salah. Yang benar adalah iwak wadi pada pilihan A yang bentuknya pendek.',
                    ],
                    3 => [
                        'benar' => 'Jawaban kamu benar. Pilihan B adalah tempat biji-bijian yang tergantung tinggi.',
                        'salah' => 'Jawaban kamu salah. Yang benar adalah tempat biji-bijian pada pilihan B yang tergantung paling tinggi.',
                    ],
                    4 => [
                        'benar' => 'Jawaban kamu benar. Pilihan A adalah jam dinding rotan yang tergantung paling rendah.',
                        'salah' => 'Jawaban kamu salah. Yang benar adalah jam dinding rotan pada pilihan A yang tergantung paling rendah.',
                    ],
                ];
            @endphp

            @foreach (range(1, 4) as $no)
                <div class="mb-5 fs-5">

                    <p class="mb-3"><strong>{{ $no }}. {{ $soalText[$no] }}</strong>
                    <button 
                        onclick="toggleAudio(this)" 
                        type="button" 
                        class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2"
                        data-id="hal4_{{ $no }}" 
                        data-playing="false">
                        🔊
                    </button>
                    <audio id="audio-hal4_{{ $no }}" src="{{ asset('sounds/materi/hal4/hal4_' . $no . '.mp3') }}"></audio>
                    </p>

                    <div class="position-relative mx-auto mb-3 soal-pilihan-gambar" style="max-width: 600px; height: 350px;">
                        <img src="{{ asset('images/materi/soal'.$no.'_bg.png') }}" class="w-100 h-100 rounded shadow" style="object-fit: cover;">

                        {{-- Gambar Pilihan A --}}
                        <label for="soal{{ $no }}a" 
                            class="soal-label-gambar position-absolute d-flex flex-column align-items-center"
                            style="top: {{ $positions[$no]['a_top'] }}; left: {{ $positions[$no]['a_left'] }}; transform: translate(-50%, -50%); cursor: pointer; z-index: 10;">
                            <img src="{{ asset('images/materi/soal'.$no.'_a.png') }}"
                                width="140"
                                height="140"
                                class="shadow img-radio-pilihan
                                @if($sudahMenjawab && (isset($jawabanUser['soal'.$no]) && $jawabanUser['soal'.$no]=='a'))
                                    @if($kunci['soal'.$no] == 'a')
                                        border border-3 border-success
                                    @else
                                        border border-3 border-danger
                                    @endif
                                @elseif(!$sudahMenjawab && old('jawaban.soal'.$no) === 'a')
                                    border border-3 border-primary
                                @endif"
                                style="border-radius:14px; transition:.2s;">
                            <input type="radio"
                                class="form-check-input radio-pilihan mt-2"
                                name="jawaban[soal{{ $no }}]"
                                value="a"
                                id="soal{{ $no }}a"
                                required
                                style="transform:scale(1.4); margin-top:7px; background:white;"
                                @if(old('jawaban.soal'.$no) === 'a') checked @endif
                                @if($sudahMenjawab) disabled @endif
                            >
                            <span class="badge bg-coklapbet text-white mt-1">A</span>
                        </label>

                        {{-- Gambar Pilihan B --}}
                        <label for="soal{{ $no }}b" 
                            class="soal-label-gambar position-absolute d-flex flex-column align-items-center"
                            style="top: {{ $positions[$no]['b_top'] }}; left: {{ $positions[$no]['b_left'] }}; transform: translate(-50%, -50%); cursor: pointer; z-index: 10;">
                            <img src="{{ asset('images/materi/soal'.$no.'_b.png') }}"
                                width="140"
                                height="140"
                                class="shadow img-radio-pilihan
                                @if($sudahMenjawab && (isset($jawabanUser['soal'.$no]) && $jawabanUser['soal'.$no]=='b'))
                                    @if($kunci['soal'.$no] == 'b')
                                        border border-3 border-success
                                    @else
                                        border border-3 border-danger
                                    @endif
                                @elseif(!$sudahMenjawab && old('jawaban.soal'.$no) === 'b')
                                    border border-3 border-primary
                                @endif"
                                style="border-radius:14px; transition:.2s;">
                            <input type="radio"
                                class="form-check-input radio-pilihan mt-2"
                                name="jawaban[soal{{ $no }}]"
                                value="b"
                                id="soal{{ $no }}b"
                                style="transform:scale(1.4); margin-top:7px; background:white;"
                                @if(old('jawaban.soal'.$no) === 'b') checked @endif
                                @if($sudahMenjawab) disabled @endif
                            >
                            <span class="badge bg-coklapbet text-white mt-1">B</span>
                        </label>

                        {{-- Jawaban --}}
                        @if($sudahMenjawab)
                            <div class="position-absolute w-100 text-center" style="bottom: 12px; left: 0;">
                                <span class="badge bg-warning text-dark">Jawaban Kamu: {{ strtoupper($jawabanUser['soal'.$no] ?? '-') }}</span>
                                @if($skor >= $kkm)
                                    <div class="mt-1">
                                        <span class="badge bg-success">Kunci Jawaban: {{ strtoupper($kunci['soal'.$no]) }}</span>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>

                    {{-- Penjelasan benar/salah tampil langsung setelah jawab --}}
                    @if($sudahMenjawab && isset($jawabanUser['soal'.$no]))
                        <div class="mt-2 mb-3">
                            @php
                                $jawabUser = $jawabanUser['soal'.$no] ?? null;
                                $kunciJawab = $kunci['soal'.$no] ?? null;
                                $isCorrect = $jawabUser === $kunciJawab;
                                $explainType = $isCorrect ? 'benar' : 'salah';
                                $explain = $penjelasan[$no][$explainType] ?? 'Belum memilih jawaban.';
                            @endphp
                            <span class="badge @if($isCorrect) bg-success @else bg-danger @endif text-white mb-1">
                                Jawaban {{ $isCorrect ? 'Benar' : 'Salah' }}
                            </span>
                            <div class="card card-body border-info bg-light">
                                {!! $explain !!}
                            </div>
                        </div>
                    @endif

                </div>
            @endforeach

            @if(!$sudahMenjawab)
                <div class="d-flex justify-content-end">
                    <button type="submit" id="submitBtn" class="btn bg-coklap2 text-white fs-5">Kirim Jawaban</button>
                </div>
            @endif
        </form>

        @if($sudahMenjawab && $skor < $kkm)
            <form action="{{ route('admin.materi.halaman4.reset') }}" method="POST" class="mt-3">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger fs-5">Ulangi Kuis</button>
            </form>
            <div class="alert alert-warning mt-3 fs-5">
                Nilai kamu belum mencapai KKM. Silakan ulangi kuis ini.
            </div>
        @elseif($sudahMenjawab && $skor >= $kkm)
            <br>
            <div class="text-center flex-grow-1 fs-5">
                <div class="alert alert-info d-inline-block mb-0">
                    Nilai Anda: {{ $skor }} / 100
                </div>
            </div>
            <br><div class="alert alert-success mt-3 fs-5">
                Selamat, kamu telah mencapai KKM. Kamu boleh melanjutkan ke halaman berikutnya.
            </div>
        @endif
    </div>

    <div class="card-footer d-flex justify-content-between">
        <a href="{{ route('admin.materi.halaman3') }}" class="btn bg-coklap2 text-white fs-5">← Sebelumnya</a>

        @if($sudahMenjawab && $skor >= $kkm)
            <a href="{{ route('admin.materi.halaman5') }}" class="btn bg-coklap1 text-white fs-5">Selanjutnya →</a>
        @else
            <button class="btn bg-coklap1 text-white disabled">Selanjutnya →</button>
        @endif
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

        // Hentikan semua audio selain yang sedang dipilih
        document.querySelectorAll('audio').forEach(a => {
            if (a !== audio) {
                a.pause();
                a.currentTime = 0;
            }
        });

        // Reset semua tombol selain tombol aktif
        document.querySelectorAll('button[data-id]').forEach(btn => {
            if (btn !== button) {
                btn.innerText = '🔊';
                btn.setAttribute('data-playing', 'false');
            }
        });

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

        audio.onended = function () {
            button.innerText = '🔊';
            button.setAttribute('data-playing', 'false');
        };
    }

    // Highlight border gambar jika radio dipilih (belum submit)
    document.addEventListener('DOMContentLoaded', function() {
        @if(!$sudahMenjawab)
        document.querySelectorAll('.radio-pilihan').forEach(function(radio) {
            radio.addEventListener('change', function() {
                let name = this.name;
                document.querySelectorAll('[name="'+name+'"]').forEach(function(r){
                    let img = r.closest('label').querySelector('.img-radio-pilihan');
                    if (img) img.classList.remove('border', 'border-3', 'border-primary');
                });
                let img = this.closest('label').querySelector('.img-radio-pilihan');
                if (img) img.classList.add('border', 'border-3', 'border-primary');
            });
        });
        @endif
    });
</script>
<style>
    .radio-pilihan {
        accent-color: #D2691E;
        box-shadow: 0 2px 8px rgba(0,0,0,0.12);
        border-width:2px;
    }
    .soal-label-gambar .img-radio-pilihan {
        transition: border .2s, box-shadow .2s;
        box-shadow: 0 0 6px 2px rgba(0,0,0,.08);
        cursor: pointer;
    }
    .soal-label-gambar .img-radio-pilihan.border-primary {
        box-shadow: 0 0 0 4px #D2691E55;
    }
    .soal-label-gambar .img-radio-pilihan.border-danger {
        border-color: #dc3545 !important;
        box-shadow: 0 0 0 4px #dc354533;
    }
    .soal-label-gambar .img-radio-pilihan.border-success {
        border-color: #198754 !important;
        box-shadow: 0 0 0 4px #19875433;
    }
</style>
@endsection
