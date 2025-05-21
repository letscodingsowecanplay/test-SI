@extends('layouts.master')

@section('title', 'Ayo Berlatih')

@section('content')
<div class="card bg-coklat">
    <div class="card-header">
        <h4 class="mb-0">Ayo Berlatih</h4>
    </div>

    <div class="card-body">
        @if($status !== null)
            <div class="alert alert-info">
                Nilai kamu: <strong>{{ round($skor, 2) }} / {{ count($soal) }}</strong><br>
                KKM: {{ $kkm }}%
            </div>
        @endif

        @if($status === null)
            <form method="POST" action="{{ route('admin.materi.halaman10.submit') }}">
                @csrf
        @endif

        <p>
            Pilihlah salah satu jawaban yang benar dari pilihan A, B, dan C!
            <button type="button" onclick="document.getElementById('audioContoh').play()" class="btn btn-sm bg-coklapbet text-white ms-2">🔊</button>
            <audio id="audioContoh" src="{{ asset('audio/materi/hal9_soal0.mp3') }}"></audio>
        </p>

        @foreach($soal as $index => $item)
            <div class="card mb-4" style="background-color: #e3caa5; color: black; padding: 20px; border-radius: 10px;">
                <p class="fw-bold">
                    {{ $item['pertanyaan'] }}
                    @if(!empty($item['audio']))
                        <button onclick="playSound('soal-{{ $index }}')" type="button" class="btn btn-sm btn-outline-dark ms-2 bg-coklapbet text-white" title="Dengarkan">
                            🔊
                        </button>
                        <audio id="audio-soal-{{ $index }}" src="{{ asset($item['audio']) }}"></audio>
                    @endif
                </p>

                @if(!empty($item['gambar']))
                    <img src="{{ asset('images/materi/ayo-berlatih-2/' . $item['gambar']) }}" alt="Gambar soal {{ $index + 1 }}" class="img-fluid mb-3" style="max-width: 300px; border-radius: 8px;">
                @endif

                @foreach($item['pilihan'] as $key => $pilihan)
                    <div class="card mb-2" style="background-color: #C68642; color: white;">
                        <div class="card-body p-2">
                            @if($status === null)
                                <div class="form-check">
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
                                </div>
                            @else
                                <div>
                                    <span>{{ strtoupper($key) }}) {{ $pilihan }}</span>
                                    @if($status === 'lulus')
                                        @if(isset($kunciJawaban[$index]) && $kunciJawaban[$index] === $key)
                                            <span class="badge bg-success ms-2">Kunci Jawaban</span>
                                        @endif
                                    @endif

                                    @if(isset($jawabanUser[$index]) && $jawabanUser[$index] === $key)
                                        <span class="badge bg-danger ms-2">Jawaban Kamu</span>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach

        @if($status === null)
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-light text-dark fw-bold">Kirim Jawaban</button>
            </div>
            </form>
        @endif

        @if($status === 'tidak_lulus')
            <form action="{{ route('admin.materi.halaman10.reset') }}" method="POST" class="mb-3 mt-3">
                @csrf
                <button type="submit" class="btn btn-danger">Ulangi Kuis</button>
            </form>
        @endif

        @if($status === 'tidak_lulus')
            <div class="alert alert-warning mt-3">
                Nilai kamu belum mencapai KKM. Silakan ulangi kuis ini.
            </div>
        @elseif($status === 'lulus')
            <div class="text-center flex-grow-1">
                <div class="alert alert-info d-inline-block mb-0">
                    Skor Anda: {{ round($skor, 2) }} / {{ count($soal) }}
                </div>
            </div><br>
            <div class="alert alert-success mt-3">
                Selamat, kamu telah mencapai KKM. Kamu boleh melanjutkan ke halaman berikutnya.
            </div>
        @endif
    </div>

    <div class="card-footer d-flex justify-content-between align-items-center">
        <a href="{{ route('admin.materi.halaman9') }}" class="btn btn-secondary">← Sebelumnya</a>

        @if($status === 'lulus')
            <a href="{{ route('admin.materi.halaman11') }}" class="btn btn-success">Selanjutnya →</a>
        @else
            <button class="btn btn-primary disabled">Selanjutnya →</button>
        @endif
    </div>
</div>

<script>
    function playSound(id) {
        const audio = document.getElementById('audio-' + id);
        if (audio) {
            audio.play();
        }
    }
</script>
@endsection
