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

        <p>Perhatikan gambar berikut dengan cermat! Isilah titik-titik di bawah ini dengan kata <strong>panjang/pendek/tinggi/rendah</strong>.</p>

        <form action="{{ route('admin.materi.halaman5.simpan') }}" method="POST">
            @csrf

            @foreach(range(1, 4) as $no)
                <div class="mb-4">
                    <h5 class="mb-2">Soal {{ $no }}</h5>
                    <div class="mb-2">
                        <img src="{{ asset('images/kuis2/soal'.$no.'.png') }}" alt="Soal {{ $no }}" class="img-fluid rounded shadow">
                    </div>
                    <p>
                        {!! match($no) {
                            1 => 'Sendok nasi dari kayu ulin ini berukuran <strong>________</strong> dibandingkan sutil dari kayu ulin.',
                            2 => 'Kotak tisu yang terbuat dari batok kelapa ini memiliki ukuran <strong>________</strong> dibandingkan kotak pensil kain motif Dayak di sebelahnya.',
                            3 => 'Tugu khatulistiwa yang berada di Kalimantan Barat ini berukuran <strong>________</strong> dibandingkan versi miniaturnya.',
                            4 => 'Miniatur perisai dayak itu sangat <strong>________</strong> dibandingkan versi aslinya.',
                        } !!}
                        <button onclick="playSound('paragraf-belajar-{{ $no }}')" type="button" class="btn btn-sm btn-outline-dark ms-2 bg-coklapbet text-white" title="Dengarkan">
                            🔊
                        </button>
                        <audio id="audio-paragraf-belajar-{{ $no }}" src="{{ asset('sounds/materi/paragraf-belajar-'.$no.'.mp3') }}"></audio>
                    </p>

                    @if(!$sudahMenjawab)
                        <div>
                            <select name="jawaban[soal{{ $no }}]" class="form-select" required>
                                <option value="">-- Pilih jawaban --</option>
                                <option value="panjang">panjang</option>
                                <option value="pendek">pendek</option>
                                <option value="tinggi">tinggi</option>
                                <option value="rendah">rendah</option>
                                <option value="besar">besar</option>
                                <option value="kecil">kecil</option>
                            </select>
                        </div>
                    @elseif($skor >= $kkm)
                        <div class="mt-2">
                            <span class="badge bg-success">Kunci Jawaban: {{ $kunci['soal'.$no] }}</span>
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
    </div>

    <div class="d-flex justify-content-between align-items-center mt-4">
        <a href="{{ route('admin.materi.halaman4') }}" class="btn btn-secondary">
            ← Sebelumnya
        </a>

        <div class="text-center flex-grow-1">
            <div class="alert alert-info d-inline-block mb-0">
                Skor Anda: {{ $skor }}/{{ $kkm + 1 }}
            </div>
        </div>

        <a href="{{ route('admin.materi.halaman6') }}" class="btn btn-success">
            Selanjutnya →
        </a>
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
