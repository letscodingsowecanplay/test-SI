@extends('layouts.master')

@section('content')
<div class="card bg-coklat">
    <div class="card-header">
        <h4 class="mb-0">Ayo Berlatih</h4>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <p>
            Amati gambar berikut dengan saksama! Isilah titik-titik di bawah ini menggunakan pilihan kata <strong>panjang</strong>, <strong>pendek</strong>, <strong>tinggi</strong>, atau <strong>rendah</strong> melalui menu dropdown.
            <button onclick="toggleAudio(this)" 
                    class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2"
                    data-id="index-1" data-playing="false">🔊</button>
            <audio id="audio-index-1" src="{{ asset('sounds/materi/hal5/1.mp3') }}"></audio>
        </p>

        <form action="{{ route('admin.materi.halaman5.simpan') }}" method="POST">
            @csrf

            @php
                // Penjelasan dua tipe saja: BENAR atau SALAH
                $penjelasan = [
                    1 => [
                        'benar' => 'Jawaban kamu benar. Sendok nasi memang berukuran pendek daripada sutil.',
                        'salah' => 'Jawaban kamu salah. Perhatikan ukuran sendok nasi dengan sutil pada gambar.'
                    ],
                    2 => [
                        'benar' => 'Jawaban kamu benar. Kotak tisu memang berukuran panjang dari kotak pensil.',
                        'salah' => 'Jawaban kamu salah. Perhatikan ukuran kotak tisu dengan kotak pensil pada gambar..'
                    ],
                    3 => [
                        'benar' => 'Jawaban kamu benar. Tugu asli memang berukuran tinggi dari versi miniaturnya.',
                        'salah' => 'Jawaban kamu salah. Perhatikan perbandingan tugu asli dengan miniatur pada gambar.'
                    ],
                    4 => [
                        'benar' => 'Jawaban kamu benar. Miniatur perisai dayak memang berukuran rendah dari aslinya.',
                        'salah' => 'Jawaban kamu salah. Perhatikan perbandingan miniatur perisai daya dengan aslinya pada gambar.'
                    ],
                ];
            @endphp

            @foreach(range(1, 4) as $no)
                <div class="mb-4">
                    <h5 class="mb-2">{{ $no }}. </h5>
                    <div class="row mb-2 align-items-center">
                        <div class="col-6 text-center">
                            <img src="{{ asset("images/materi/ayo-berlatih-1/soal{$no}a.png") }}" alt="Soal {{ $no }}a" class="img-fluid rounded shadow" style="max-height: 150px;">
                        </div>
                        <div class="col-6 text-center">
                            <img src="{{ asset("images/materi/ayo-berlatih-1/soal{$no}b.png") }}" alt="Soal {{ $no }}b" class="img-fluid rounded shadow" style="max-height: 150px;">
                        </div>
                    </div>

                    <p>
                        {!! match($no) {
                            1 => 'Sendok nasi dari kayu ulin ini berukuran <strong>________</strong> dibandingkan sutil dari kayu ulin.',
                            2 => 'Kotak tisu yang terbuat dari batok kelapa ini memiliki ukuran <strong>________</strong> dibandingkan kotak pensil kain motif Dayak di sebelahnya.',
                            3 => 'Tugu khatulistiwa yang berada di Kalimantan Barat ini berukuran <strong>________</strong> dibandingkan versi miniaturnya.',
                            4 => 'Miniatur perisai dayak itu sangat <strong>________</strong> dibandingkan versi aslinya.',
                        } !!}
                        <button 
                            type="button" 
                            onclick="toggleAudio(this)" 
                            class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2" 
                            title="Dengarkan"
                            data-id="hal5-{{ $no }}" 
                            data-playing="false">
                            🔊
                        </button>
                        <audio id="audio-hal5-{{ $no }}" src="{{ asset('sounds/materi/hal5/hal5-' . $no . '.mp3') }}"></audio>
                    </p>

                    @if(!$sudahMenjawab)
                        <select name="jawaban[soal{{ $no }}]" class="form-select" required>
                            <option value="">-- Pilih jawaban --</option>
                            @foreach(['panjang', 'pendek', 'tinggi', 'rendah'] as $opsi)
                                <option value="{{ $opsi }}" @if(old("jawaban.soal$no") == $opsi) selected @endif>{{ $opsi }}</option>
                            @endforeach
                        </select>
                    @else
                        <div class="mt-2">
                            <span class="badge bg-warning text-dark">Jawaban Kamu: {{ $jawabanUser['soal'.$no] ?? '-' }}</span>
                            @if($skor >= $kkm)
                                <span class="badge bg-success ms-1">Kunci Jawaban: {{ $kunci['soal'.$no] }}</span>
                            @endif
                        </div>
                    @endif

                    {{-- Penjelasan tampil setelah user menjawab --}}
                    @if($sudahMenjawab && !empty($jawabanUser['soal'.$no]))
                        <div class="card card-body border-info bg-light mt-2">
                            @php
                                $userAnswer = $jawabanUser['soal'.$no] ?? null;
                                $kunciJawab = $kunci['soal'.$no] ?? null;
                                $isCorrect = $userAnswer === $kunciJawab;
                                $explainType = $isCorrect ? 'benar' : 'salah';
                                $explain = $penjelasan[$no][$explainType] ?? 'Kamu belum memilih jawaban.';
                            @endphp
                            {!! $explain !!}
                            
                        </div>
                    @endif
                </div>
            @endforeach

            @if(!$sudahMenjawab)
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn bg-coklap2 text-white">Kirim Jawaban</button>
                </div>
            @endif
        </form>

        @if($sudahMenjawab && $skor < $kkm)
            <form action="{{ route('admin.materi.halaman5.reset') }}" method="POST" class="mt-3">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Ulangi Kuis</button>
            </form>
            <div class="alert alert-warning mt-3">
                Nilai kamu belum mencapai KKM. Silakan ulangi kuis ini.
            </div>
        @elseif($sudahMenjawab && $skor >= $kkm)
            <br><div class="text-center flex-grow-1">
                <div class="alert alert-info d-inline-block mb-0">
                    Skor Anda: {{ $skor }} / 4
                </div>
            </div><br>
            <div class="alert alert-success mt-3">
                Selamat, kamu telah mencapai KKM. Kamu boleh melanjutkan ke halaman berikutnya.
            </div>
        @endif
    </div>

    <div class="card-footer d-flex justify-content-between">
        <a href="{{ route('admin.materi.halaman4') }}" class="btn bg-coklap2 text-white">
            ← Sebelumnya
        </a>

        @if($sudahMenjawab && $skor >= $kkm)
            <a href="{{ route('admin.materi.halaman6') }}" class="btn bg-coklap1 text-white">
                Selanjutnya →
            </a>
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

        // Stop semua audio lain
        document.querySelectorAll('audio').forEach(a => {
            if (a !== audio) {
                a.pause();
                a.currentTime = 0;
            }
        });

        // Reset semua tombol ikon
        document.querySelectorAll('button[data-id]').forEach(btn => {
            if (btn !== button) {
                btn.innerText = '🔊';
                btn.setAttribute('data-playing', 'false');
            }
        });

        // Play / Pause toggle
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

        // Reset ikon setelah audio selesai
        audio.onended = function () {
            button.innerText = '🔊';
            button.setAttribute('data-playing', 'false');
        };
    }
</script>
@endsection
