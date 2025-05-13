@extends('layouts.master')

@section('content')
<div class="card bg-coklat">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Kuis Panjang dan Pendek</h4>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form id="kuisForm" action="{{ route('admin.materi.halaman4.simpan') }}" method="POST">
            @csrf

            @foreach (range(1,4) as $no)
                <div class="mb-5">
                    <button onclick="document.getElementById('audio{{ $no }}').play()" type="button" class="btn btn-sm btn-secondary mb-2">
                        🔊 Putar Suara
                    </button>
                    <audio id="audio{{ $no }}" src="{{ asset('audio/materi/soal'.$no.'.mp3') }}"></audio>

                    <h5 class="mb-3">Soal {{ $no }}: Perhatikan gambar berikut dengan cermat!</h5>

                    <div class="position-relative mx-auto mb-5" style="max-width: 600px; height: 350px;">
                        <img src="{{ asset('images/materi/soal'.$no.'_bg.png') }}" 
                            class="w-100 h-100 rounded shadow" 
                            alt="Gambar Soal" 
                            style="object-fit: cover;">

                        @php
                            $positions = [
                                1 => ['a_top' => '60%', 'b_top' => '70%'],
                                2 => ['a_top' => '65%', 'b_top' => '65%'],
                                3 => ['a_top' => '55%', 'b_top' => '75%'],
                                4 => ['a_top' => '68%', 'b_top' => '62%'],
                            ];
                        @endphp

                        <div class="position-absolute" style="top: {{ $positions[$no]['a_top'] }}; left: 25%; transform: translate(-50%, -50%);">
                            <img src="{{ asset('images/materi/soal'.$no.'_a.png') }}" alt="Pilihan A" width="150" height="150" class="shadow">
                        </div>

                        <div class="position-absolute" style="top: {{ $positions[$no]['b_top'] }}; left: 75%; transform: translate(-50%, -50%);">
                            <img src="{{ asset('images/materi/soal'.$no.'_b.png') }}" alt="Pilihan B" width="150" height="150" class="shadow">
                        </div>

                        <div class="position-absolute w-100 text-center" style="bottom: 10px;">
                            <div class="row justify-content-center">
                                <div class="col-6 text-center">
                                    <input type="radio" class="form-check-input me-1" name="jawaban[soal{{ $no }}]" value="a" id="soal{{ $no }}a" required>
                                    <label class="form-check-label" for="soal{{ $no }}a">Pilihan A</label>
                                </div>
                                <div class="col-6 text-center">
                                    <input type="radio" class="form-check-input me-1" name="jawaban[soal{{ $no }}]" value="b" id="soal{{ $no }}b">
                                    <label class="form-check-label" for="soal{{ $no }}b">Pilihan B</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="d-flex justify-content-end">
                <button type="submit" id="submitBtn" class="btn btn-primary">Kirim Jawaban</button>
            </div>
        </form>
    </div>

    <div class="card-footer d-flex justify-content-between">
        <a href="{{ route('admin.materi.halaman3') }}" class="btn btn-secondary">← Halaman 3</a>

        @if($sudahMenjawab)
            <a href="{{ route('admin.materi.halaman5') }}" class="btn btn-primary">Mulai Kuis</a>  
        @else
            <a href="#" class="btn btn-primary disabled">Halaman 5 →</a>
        @endif
    </div>


</div>
@endsection

@push('scripts')
<script>
    const form = document.getElementById('kuisForm');

    form.addEventListener('submit', function (e) {
        const radios = form.querySelectorAll('input[type="radio"]:checked');
        if (radios.length < 4) {
            e.preventDefault();
            alert('Harap jawab semua soal sebelum mengirim.');
        }
    });
</script>
@endpush