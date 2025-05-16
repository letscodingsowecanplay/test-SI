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
            Perhatikan gambar berikut dengan cermat! Isilah titik-titik di bawah ini dengan kata <strong>panjang/pendek/tinggi/rendah</strong>.
            <button type="button" onclick="document.getElementById('audio-instruksi').play()" class="btn btn-sm bg-coklapbet text-white ms-2" title="Putar Audio">
                🔊
            </button>
        </p>
        <audio id="audio-instruksi" src="{{ asset('audio/instruksi-panjang-pendek.mp3') }}"></audio>

        <form action="{{ route('admin.materi.halaman5.simpan') }}" method="POST">
            @csrf

            @foreach(range(1, 4) as $no)
                <div class="mb-4">
                    <h5 class="mb-2">Soal {{ $no }}</h5>
                    <div class="mb-2">
                        <img src="{{ asset("images/materi/lat2/soal$no.png") }}" alt="Soal {{ $no }}" width="150" height="150" class="img-fluid rounded shadow">
                    </div>
                    <p>
                        {!! match($no) {
                            1 => 'Sendok nasi dari kayu ulin ini berukuran <strong>________</strong> dibandingkan sutil dari kayu ulin.',
                            2 => 'Kotak tisu yang terbuat dari batok kelapa ini memiliki ukuran <strong>________</strong> dibandingkan kotak pensil kain motif Dayak di sebelahnya.',
                            3 => 'Tugu khatulistiwa yang berada di Kalimantan Barat ini berukuran <strong>________</strong> dibandingkan versi miniaturnya.',
                            4 => 'Miniatur perisai dayak itu sangat <strong>________</strong> dibandingkan versi aslinya.',
                        } !!}
                        <button type="button" onclick="playSound('paragraf-belajar-{{ $no }}')" class="btn btn-sm bg-coklapbet text-white ms-2" title="Dengarkan">
                            🔊
                        </button>
                        <audio id="audio-paragraf-belajar-{{ $no }}" src="{{ asset("audio/materi/paragraf-belajar-$no.mp3") }}"></audio>
                    </p>

                    @if(!$sudahMenjawab)
                        <select name="jawaban[soal{{ $no }}]" class="form-select" required>
                            <option value="">-- Pilih jawaban --</option>
                            @foreach(['panjang', 'pendek', 'tinggi', 'rendah'] as $opsi)
                                <option value="{{ $opsi }}" @if(old("jawaban.soal$no") == $opsi) selected @endif>{{ $opsi }}</option>
                            @endforeach
                        </select>
                    @elseif($skor >= $kkm)
                        <div class="mt-2">
                            <span class="badge bg-success">Kunci Jawaban: {{ $kunci['soal'.$no] }}</span>
                        </div>
                    @else
                        <div class="mt-2">
                            <span class="badge bg-warning text-dark">Jawaban Kamu: {{ $jawabanUser['soal'.$no] ?? '-' }}</span>
                        </div>
                    @endif
                </div>
            @endforeach

            @if(!$sudahMenjawab)
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Kirim Jawaban</button>
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
            <div class="alert alert-success mt-3">
                Selamat, kamu telah mencapai KKM. Kamu boleh melanjutkan ke halaman berikutnya.
            </div>
        @endif
    </div>

    <div class="d-flex justify-content-between align-items-center mt-4">
        <a href="{{ route('admin.materi.halaman4') }}" class="btn btn-secondary">
            ← Sebelumnya
        </a>

        <div class="text-center flex-grow-1">
            <div class="alert alert-info d-inline-block mb-0">
                Skor Anda: {{ $skor }} / 4
            </div>
        </div>

        @if($sudahMenjawab && $skor >= $kkm)
            <a href="{{ route('admin.materi.halaman6') }}" class="btn btn-success">
                Selanjutnya →
            </a>
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
