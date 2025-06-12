@extends('layouts.master')

@section('title', 'Ayo Berlatih')

@section('content')
<div class="card bg-coklat fs-5">
    <div class="card-header">
        <h4 class="mb-0">Ayo Berlatih</h4>
    </div>

    <div class="card-body">

        @if($status === null)
            <form method="POST" action="{{ route('admin.materi.halaman10.submit') }}">
                @csrf
        @endif

        <p>
            Pilihlah salah satu jawaban yang benar dari pilihan A, B, dan C!
            <button onclick="toggleAudio(this)" 
                    class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2"
                    data-id="index-1" data-playing="false" type="button">🔊</button>
            <audio id="audio-index-1" src="{{ asset('sounds/materi/hal10/1.mp3') }}"></audio>
        </p>

        @php
        // Penjelasan dua tipe untuk setiap soal
        $penjelasan = [
            0 => [
                'benar' => 'Jawaban kamu benar. Urutan miniatur rumah banjar dari yang paling tinggi adalah a-b-c.',
                'salah' => 'Jawaban kamu salah. Perhatikan kembali urutan tinggi rumah pada gambar.'
            ],
            1 => [
                'benar' => 'Jawaban kamu benar. Tas kerajinan khas Kalimantan yang digantung paling rendah adalah a-b-c.',
                'salah' => 'Jawaban kamu salah. Lihat kembali posisi tas pada gambar.'
            ],
            2 => [
                'benar' => 'Jawaban kamu benar. Urutan patung dayak fiber glass dari yang paling panjang adalah b, a, lalu c sesuai gambar.',
                'salah' => 'Jawaban kamu salah. Cermati kembali ukuran patung.'
            ],
            3 => [
                'benar' => 'Jawaban kamu benar. Urutan vas bunga akar keladi dari yang paling pendek adalah c, lalu b, dan paling tinggi a.',
                'salah' => 'Jawaban kamu salah. Perhatikan kembali ukuran vas pada gambar.'
            ],
            4 => [
                'benar' => 'Jawaban kamu benar. Urutan kain sasirangan dari yang paling panjang adalah a, lalu c, lalu b.',
                'salah' => 'Jawaban kamu salah. Lihat kembali panjang kain pada gambar.'
            ],
        ];
        @endphp

        @foreach($soal as $index => $item)
            @php
                $no = $index + 1;
                $userAnswer = $jawabanUser[$index] ?? null;
                $kunci = $kunciJawaban[$index] ?? null;
                $penjelasanSoal = $penjelasan[$index] ?? ['benar' => '', 'salah' => ''];
            @endphp
            <div class="card mb-4 bg-coklat">
                <p class="fw-bold">
                    {{ $item['pertanyaan'] }}
                    @if(!empty($item['audio']))
                        <button 
                            type="button" 
                            onclick="toggleAudio(this)" 
                            class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2" 
                            title="Dengarkan"
                            data-id="hal10-{{ $no }}" 
                            data-playing="false">
                            🔊
                        </button>
                        <audio id="audio-hal10-{{ $no }}" src="{{ asset('sounds/materi/hal10/hal10-' . $no . '.mp3') }}"></audio>
                    @endif
                </p>

                @if(!empty($item['gambar']))
                    <img src="{{ asset('images/materi/ayo-berlatih-2/' . $item['gambar']) }}" alt="Gambar soal {{ $no }}" class="img-fluid mb-3" style="max-width: 300px; border-radius: 8px;">
                @endif

                @foreach($item['pilihan'] as $key => $pilihan)
                    @php
                        $isUserAnswer = ($userAnswer === $key);
                        $isKunci = ($kunci === $key);
                        $highlightClass = '';

                        if($status !== null && $isUserAnswer) {
                            if($userAnswer === $kunci) {
                                $highlightClass = 'bg-success text-white';
                            } else {
                                $highlightClass = 'bg-danger text-white';
                            }
                        }
                        // File audio per pilihan
                        $audioPilihan = asset("sounds/materi/hal10/pilihan/{$no}-{$key}.mp3");
                        $audioId = "audio-hal10-{$no}-{$key}";
                    @endphp
                    <div class="card mb-2 bg-cokren {{ $highlightClass }}">
                        <div class="card-body p-2 d-flex align-items-center">
                            @if($status === null)
                                <div class="form-check flex-grow-1">
                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        name="jawaban_{{ $index }}"
                                        id="soal{{ $index }}_{{ $key }}"
                                        value="{{ $key }}"
                                        required
                                        @if(old("jawaban_$index") === $key) checked @endif
                                    >
                                    <label class="form-check-label" for="soal{{ $index }}_{{ $key }}">
                                        {{ strtoupper($key) }}) {{ $pilihan }}
                                    </label>
                                    {{-- Tombol audio per pilihan jawaban --}}
                                    <button type="button" onclick="toggleAudio(this)" 
                                        class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2"
                                        data-id="{{ $audioId }}" data-playing="false">🔊</button>
                                    <audio id="{{ $audioId }}" src="{{ $audioPilihan }}"></audio>
                                </div>
                            @else
                                <div class="flex-grow-1">
                                    <span>{{ strtoupper($key) }}) {{ $pilihan }}</span>
                                    @if($status === 'lulus' && $isKunci)
                                        <span class="badge bg-success ms-2">Kunci Jawaban</span>
                                    @endif
                                    @if($isUserAnswer)
                                        <span class="badge bg-light text-dark ms-2">Jawaban Kamu</span>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach

                {{-- Penjelasan tampil jika pengguna sudah menjawab --}}
                @if($userAnswer)
                    <div class="card card-body border-info bg-light mt-2">
                        @php
                            $isCorrect = $userAnswer === $kunci;
                            $explainType = $isCorrect ? 'benar' : 'salah';
                            $explain = $penjelasanSoal[$explainType] ?? '';
                        @endphp
                        {!! $explain !!}
                    </div>
                @endif
            </div>
        @endforeach

        @if($status === null)
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn bg-coklap2 text-white fs-5">Kirim Jawaban</button>
            </div>
            </form>
        @endif

        @if($status === 'tidak_lulus')
            <form action="{{ route('admin.materi.halaman10.reset') }}" method="POST" class="mb-3 mt-3">
                @csrf
                <button type="submit" class="btn btn-danger fs-5">Ulangi Kuis</button>
            </form>
        @endif

        @if($status === 'tidak_lulus')
            <div class="alert alert-warning mt-3">
                Nilai kamu belum mencapai KKM. Silakan ulangi kuis ini.
            </div>
        @elseif($status === 'lulus')
            <div class="text-center flex-grow-1">
                <div class="alert alert-info d-inline-block mb-0">
                    Nilai Anda: {{$skor}} / 100
                </div>
            </div><br>
            <div class="alert alert-success mt-3">
                Selamat, kamu telah mencapai KKM. Kamu boleh melanjutkan ke halaman berikutnya.
            </div>
        @endif
    </div>

    <div class="card-footer d-flex justify-content-between align-items-center">
        <a href="{{ route('admin.materi.halaman9') }}" class="btn bg-coklap2 text-white fs-5">← Sebelumnya</a>
        @if($status === 'lulus')
            <a href="{{ route('admin.materi.halaman11') }}" class="btn bg-coklap1 text-white fs-5">Selanjutnya →</a>
        @else
            <button class="btn bg-coklap1 text-white disabled fs-5">Selanjutnya →</button>
        @endif
    </div>
</div>
<br>

<script>
    let currentAudio = null;
    let currentButton = null;

    function toggleAudio(button) {
        const id = button.getAttribute('data-id');
        const audio = document.getElementById(id);

        // Stop semua audio lain
        document.querySelectorAll('audio').forEach(a => {
            if (a !== audio) {
                a.pause();
                a.currentTime = 0;
            }
        });

        // Reset semua ikon tombol
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
