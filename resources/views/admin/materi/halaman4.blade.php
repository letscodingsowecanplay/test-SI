@extends('layouts.master')

@section('content')
<div class="card bg-coklat">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Latihan 1</h4>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="mb-5">
            <h5 class="mb-3 d-flex align-items-center">
                <strong>Contoh Soal</strong>
                <button onclick="document.getElementById('audio_contoh1').play()" type="button" class="btn btn-sm bg-coklapbet text-white ms-2">🔊</button>
                <audio id="audio_hal4_7" src="{{ asset('audio/materi/hal4/7.mp3') }}"></audio>
            </h5>

            <p>
                Amati gambar berikut dengan saksama.
            </p>
            <p>
                <strong>Pilih makanan dengan bentuk yang tinggi!</strong>
                <button onclick="document.getElementById('audio_contoh3').play()" type="button" class="btn btn-sm bg-coklapbet text-white ms-2">🔊</button>
                <audio id="audio_hal4_6" src="{{ asset('audio/materi/hal4/6.mp3') }}"></audio>
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
                    Ketika kita amati kedua makanan ini, pundut di sebelah kanan memiliki bentuk yang rendah, sedangkan nasi kuning di sebelah kiri memiliki bentuk yang tinggi. Oleh karena itu, kita memilih gambar pundut.
                </p>
            </div>
        </div>

        <hr>

        <h5 class="mb-3 d-flex align-items-center">
            <strong>Ayo Mencoba</strong>
            <button onclick="document.getElementById('audio_contoh1').play()" type="button" class="btn btn-sm bg-coklapbet text-white ms-2">🔊</button>
            <audio id="audio_hal4_5" src="{{ asset('audio/materi/hal4/5.mp3') }}"></audio>
        </h5>
        <p>
            Amati gambar berikut dengan saksama.
        </p>

        <form id="kuisForm" action="{{ route('admin.materi.halaman4.simpan') }}" method="POST">
            @csrf

            @php
                $soalText = [
                    1 => 'Pilih iwak dengan bentuk yang pendek!',
                    2 => 'Pilih olahan iwak wadi khas banjar dengan bentuk yang pendek!',
                    3 => 'Pilih tempat biji-bijian khas Kalimantan yang tergantung tinggi!',
                    4 => 'Pilih jam dinding rotan oleh-oleh khas Kalimantan yang tergantung rendah!',
                ];
                $positions = [
                    1 => ['a_top' => '60%', 'b_top' => '60%'],
                    2 => ['a_top' => '65%', 'b_top' => '65%'],
                    3 => ['a_top' => '55%', 'b_top' => '35%'],
                    4 => ['a_top' => '55%', 'b_top' => '35%'],
                ];
            @endphp

            @foreach (range(1, 4) as $no)
                <div class="mb-5">
                    <button onclick="document.getElementById('audio{{ $no }}').play()" type="button" class="btn btn-sm mb-2 bg-coklapbet text-white">🔊</button>
                    <audio id="audio_hal4_{{ $no }}" src="{{ asset('audio/materi/hal4/'.$no.'.mp3') }}"></audio>

                    <p class="mb-3"><strong>{{ $no }}. {{ $soalText[$no] }}</strong></p>

                    <div class="position-relative mx-auto mb-3" style="max-width: 600px; height: 350px;">
                        <img src="{{ asset('images/materi/soal'.$no.'_bg.png') }}" class="w-100 h-100 rounded shadow" style="object-fit: cover;">

                        <div class="position-absolute" style="top: {{ $positions[$no]['a_top'] }}; left: 25%; transform: translate(-50%, -50%);">
                            <img src="{{ asset('images/materi/soal'.$no.'_a.png') }}" width="150" height="150" class="shadow">
                        </div>

                        <div class="position-absolute" style="top: {{ $positions[$no]['b_top'] }}; left: 75%; transform: translate(-50%, -50%);">
                            <img src="{{ asset('images/materi/soal'.$no.'_b.png') }}" width="150" height="150" class="shadow">
                        </div>

                        @if(!$sudahMenjawab)
                            <div class="position-absolute w-100 text-center" style="bottom: 10px;">
                                <div class="row justify-content-center">
                                    <div class="col-6 text-center">
                                        <input type="radio" class="form-check-input me-1" name="jawaban[soal{{ $no }}]" value="a" id="soal{{ $no }}a" required>
                                        <label for="soal{{ $no }}a">Pilihan A</label>
                                    </div>
                                    <div class="col-6 text-center">
                                        <input type="radio" class="form-check-input me-1" name="jawaban[soal{{ $no }}]" value="b" id="soal{{ $no }}b">
                                        <label for="soal{{ $no }}b">Pilihan B</label>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="text-center mt-2">
                                <span class="badge bg-warning text-dark">Jawaban Kamu: {{ strtoupper($jawabanUser['soal'.$no] ?? '-') }}</span>
                                @if($skor >= $kkm)
                                    <div class="mt-1">
                                        <span class="badge bg-success">Kunci Jawaban: {{ strtoupper($kunci['soal'.$no]) }}</span>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach

            @if(!$sudahMenjawab)
                <div class="d-flex justify-content-end">
                    <button type="submit" id="submitBtn" class="btn btn-primary">Kirim Jawaban</button>
                </div>
            @endif
        </form>

        @if($sudahMenjawab && $skor < $kkm)
            <form action="{{ route('admin.materi.halaman4.reset') }}" method="POST" class="mt-3">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Ulangi Kuis</button>
            </form>
            <div class="alert alert-warning mt-3">
                Nilai kamu belum mencapai KKM. Silakan ulangi kuis ini.
            </div>
        @elseif($sudahMenjawab && $skor >= $kkm)
            <br>
            <div class="text-center flex-grow-1">
                <div class="alert alert-info d-inline-block mb-0">
                    Skor Anda: {{ $skor }} / 4
                </div>
            </div>
            <br><div class="alert alert-success mt-3">
                Selamat, kamu telah mencapai KKM. Kamu boleh melanjutkan ke halaman berikutnya.
            </div>
        @endif
    </div>

    <div class="card-footer d-flex justify-content-between">
        <a href="{{ route('admin.materi.halaman3') }}" class="btn btn-secondary">← Sebelumnya</a>

        @if($sudahMenjawab && $skor >= $kkm)
            <a href="{{ route('admin.materi.halaman5') }}" class="btn btn-success">Selanjutnya →</a>
        @else
            <button class="btn btn-primary disabled">Selanjutnya →</button>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    const form = document.getElementById('kuisForm');

    form?.addEventListener('submit', function (e) {
        const radios = form.querySelectorAll('input[type="radio"]:checked');
        if (radios.length < 4) {
            e.preventDefault();
            alert('Harap jawab semua soal sebelum mengirim.');
        }
    });
</script>
@endpush
