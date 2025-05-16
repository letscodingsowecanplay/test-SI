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
                <audio id="audio_contoh1" src="{{ asset('audio/materi/contoh1.mp3') }}"></audio>
            </h5>

            <p>
                Perhatikan gambar berikut dengan cermat!
                <button onclick="document.getElementById('audio_contoh2').play()" type="button" class="btn btn-sm bg-coklapbet text-white ms-2">🔊</button>
                <audio id="audio_contoh2" src="{{ asset('audio/materi/contoh2.mp3') }}"></audio>
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
                    <strong>Berilah tanda ✔ pada makanan yang berukuran tinggi!</strong>
                    <button onclick="document.getElementById('audio_contoh3').play()" type="button" class="btn btn-sm bg-coklapbet text-white ms-2">🔊</button>
                    <audio id="audio_contoh3" src="{{ asset('audio/materi/contoh3.mp3') }}"></audio>
                </p>
                <p>
                    <strong>Penyelesaian:</strong><br>
                    Ketika kita perhatikan dengan seksama, punudut di sebelah kanan berukuran lebih tinggi dibandingkan dengan nasi kuning di sebelah kiri. Sehingga tanda ✔ berada di gambar punudut.
                    <button onclick="document.getElementById('audio_contoh4').play()" type="button" class="btn btn-sm bg-coklapbet text-white ms-2">🔊</button>
                    <audio id="audio_contoh4" src="{{ asset('audio/materi/contoh4.mp3') }}"></audio>
                </p>
            </div>
        </div>

        <hr>

        <form id="kuisForm" action="{{ route('admin.materi.halaman4.simpan') }}" method="POST">
            @csrf

            @php
                $kunci = ['soal1' => 'a (kiri)', 'soal2' => 'b (kanan)', 'soal3' => 'a (kiri)', 'soal4' => 'b (kanan)'];
                $soalText = [
                    1 => 'Berilah tanda ✔ pada iwak yang berukuran pendek!',
                    2 => 'Berilah tanda ✔ pada wadi patin yang berukuran panjang!',
                    3 => 'Berilah tanda ✔ pada botol biji-bijian khas Kalimantan yang digantung tinggi!',
                    4 => 'Berilah tanda ✔ pada jam dinding rotan oleh-oleh khas Kalimantan yang digantung rendah!',
                ];
                $positions = [
                    1 => ['a_top' => '60%', 'b_top' => '60%'],
                    2 => ['a_top' => '65%', 'b_top' => '65%'],
                    3 => ['a_top' => '35%', 'b_top' => '55%'],
                    4 => ['a_top' => '55%', 'b_top' => '35%'],
                ];
            @endphp

            @foreach (range(1, 4) as $no)
                <div class="mb-5">
                    <button onclick="document.getElementById('audio{{ $no }}').play()" type="button" class="btn btn-sm mb-2 bg-coklapbet text-white">🔊</button>
                    <audio id="audio{{ $no }}" src="{{ asset('audio/materi/soal'.$no.'.mp3') }}"></audio>

                    <h5 class="mb-1">Soal {{ $no }}:</h5>
                    <p class="mb-3"><em>Perhatikan gambar berikut dengan cermat!</em><br><strong>{{ $soalText[$no] }}</strong></p>

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
                        @elseif($skor >= $kkm)
                            <div class="text-center mt-3">
                                <span class="badge bg-info text-dark">Kunci Jawaban: <strong>{{ strtoupper($kunci['soal'.$no]) }}</strong></span>
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
    </div>

    <div class="d-flex justify-content-between align-items-center mt-4"">
        <a href="{{ route('admin.materi.halaman3') }}" class="btn btn-secondary">← Sebelumnya</a>

        @if($sudahMenjawab)
            @if($skor >= $kkm)
                <div class="alert alert-info d-inline-block mb-0">
                    Skor Anda: {{ $skor }}/{{ $kkm + 1 }}
                </div>
                <a href="{{ route('admin.materi.halaman5') }}" class="btn btn-success">Selanjutnya →</a>
            @else
                <form action="{{ route('admin.materi.halaman4.reset') }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-warning" onclick="return confirm('Yakin ingin mengulang kuis?')">Ulangi Kuis</button>
                </form>
            @endif
        @else
            <button class="btn btn-success disabled">Selanjutnya →</button>
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
