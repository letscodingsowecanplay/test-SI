@extends('layouts.master')

@section('content')
<div class="card bg-coklat">
    <div class="card-header">
        <h4 class="mb-0">Ayo Mencoba</h4>
    </div>
    <div class="card-body px-4">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Contoh Soal --}}
        <div class="mb-5">
            <h5>Contoh Soal</h5>
            <p>Amati gambar berikut dengan saksama! Tentukan apakah pernyataan tersebut Benar atau Salah dengan menggeser slider pada pilihan jawaban.</p>

            <div class="mb-3">
                <div class="d-flex justify-content-center mb-3">
                    <div class="w-100" style="max-width: 600px;">
                        <div class="ratio ratio-16x9">
                            <iframe
                                src="https://www.youtube.com/embed/pmvty6i3mxs?si=x2Q7MqkgjDZiQ81b"
                                title="Video Contoh Soal"
                                allowfullscreen
                                style="border:0;">
                            </iframe>
                        </div>
                    </div>
                </div>

                <p>Setelah menyimak video, perhatikan pertanyaan berikut dan tentukan apakah pernyataan tersebut Benar atau Salah dengan menggeser slider pada pilihan jawaban.</p>
            </div>

            <div class="text-center mb-3">
                <img src="{{ asset('images/materi/ayo-mencoba-3/contoh.png') }}" class="img-fluid rounded shadow" alt="Contoh Soal" style="max-width: 300px; height: auto;">
            </div>

            <p class="text-center">
                Tinggi tapai di dalam wadah tersebut setara dengan 3 klip kertas.
            </p>
            <div class="d-flex justify-content-center mb-2">
                <!-- FAKE SLIDER -->
                <div style="width: 200px; height: 20px; background: #f1f1f1; border-radius: 8px; position: relative;">
                    <!-- Fake track -->
                    <div style="position: absolute; left: 170px; top: -8px;">
                        <div style="width: 32px; height: 36px; background: #d0ebc6; border-radius: 8px; display: flex; align-items: center; justify-content: center; box-shadow: 1px 1px 3px #bbb;">
                            <span style="font-size: 12px; font-weight: bold; color: #388e3c;">benar</span>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="jawaban[soalcontoh]" id="input-soalcontoh" value="benar">

            <p class="text-muted text-center"><small>Jawaban: <strong>Benar</strong></small></p>
        </div>

        <form action="{{ route('admin.materi.halaman15.simpan') }}" method="POST" id="kuisForm">
            @csrf

            @php
                $kunci = [
                    'soal1' => 'benar',
                    'soal2' => 'salah',
                    'soal3' => 'benar',
                    'soal4' => 'salah'
                ];

                $soal = [
                    1 => ['gambar' => 'soal1.png', 'teks' => 'Tinggi wadai cincin itu adalah 3 stik es krim.'],
                    2 => ['gambar' => 'soal2.png', 'teks' => 'Diameter buah asam payak adalah 1 koin.'],
                    3 => ['gambar' => 'soal3.png', 'teks' => 'Panjang buah ulin tersebut sebanyak 4 buah kotak.'],
                    4 => ['gambar' => 'soal4.png', 'teks' => 'Panjang tempat menyimpan gaharu itu sebanyak 10 pensil.']
                ];
            @endphp

            @foreach($soal as $no => $data)
                <div class="mb-5">
                    <p class="">{{ $no }}. 
                        {{ $data['teks'] }}
                        <button type="button" onclick="document.getElementById('audio-soal{{ $no }}').play()" class="btn btn-sm ms-2 bg-coklapbet text-white">🔊</button>
                        <audio id="audio-soal{{ $no }}" src="{{ asset('audio/materi/ayo-mencoba-3/soal'.$no.'.mp3') }}"></audio>
                    </p>
                    <div class="text-center mb-3">
                        <img src="{{ asset('images/materi/ayo-mencoba-3/' . $data['gambar']) }}" class="img-fluid rounded shadow" alt="Soal {{ $no }}" style="max-width: 300px; height: auto;">
                    </div>

                    @if(!$sudahMenjawab)
                        <div class="d-flex justify-content-center mb-2">
                            <div id="slider-{{ $no }}" style="width: 200px;"></div>
                        </div>
                        <input type="hidden" name="jawaban[soal{{ $no }}]" id="input-soal{{ $no }}" required>
                        <p class="text-muted text-center"><small>Geser ke kiri untuk <strong>Salah</strong>, ke kanan untuk <strong>Benar</strong></small></p>
                    @else
                        <p class="text-center">Jawaban kamu: <strong>{{ ucfirst($jawabanUser['soal'.$no] ?? '-') }}</strong></p>
                        @if($skor >= $kkm)
                            <p class="text-center">Kunci Jawaban: <strong>{{ ucfirst($kunci['soal'.$no]) }}</strong></p>
                            <div class="text-center flex-grow-1">
                                <div class="alert alert-info d-inline-block mb-0">
                                    Skor Anda: {{ round($skor, 2) }} / {{ count($soal) }}
                                </div>
                            </div>
                        @endif
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
            <form action="{{ route('admin.materi.halaman15.reset') }}" method="POST" class="mt-3">
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

    <div class="card-footer d-flex justify-content-between">
        <a href="{{ route('admin.materi.halaman14') }}" class="btn btn-secondary">← Sebelumnya</a>
        @if($sudahMenjawab && $skor >= $kkm)
            <a href="{{ route('admin.materi.halaman16') }}" class="btn btn-success">Selanjutnya →</a>
        @else
            <button class="btn btn-primary disabled">Selanjutnya →</button>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/nouislider@15.6.1/dist/nouislider.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const sliderContoh = document.getElementById('slider-contoh');
        const inputContoh = document.getElementById('input-soalcontoh');
        if (sliderContoh && inputContoh) {
            noUiSlider.create(sliderContoh, {
                start: 1,
                connect: [true, false],
                step: 1,
                range: { min: 0, max: 1 },
                format: {
                    to: value => value == 1 ? 'benar' : 'salah',
                    from: value => value === 'benar' ? 1 : 0
                },
                tooltips: [true]
            });

            function forceSliderRight(tries = 0) {
                sliderContoh.noUiSlider.set(1);
                inputContoh.value = sliderContoh.noUiSlider.get();
                console.log('Slider value (try', tries, '):', inputContoh.value);
                if (inputContoh.value !== 'benar' && tries < 10) {
                    setTimeout(() => forceSliderRight(tries + 1), 500);
                } else {
                    sliderContoh.style.pointerEvents = 'none';
                    sliderContoh.style.opacity = '0.6';
                }
            }
            forceSliderRight();
        }

        // ... kode soal lain tetap seperti biasa
        @foreach($soal as $no => $data)
            const slider{{ $no }} = document.getElementById('slider-{{ $no }}');
            const input{{ $no }} = document.getElementById('input-soal{{ $no }}');

            if (slider{{ $no }}) {
                noUiSlider.create(slider{{ $no }}, {
                    start: 0,
                    connect: [true, false],
                    step: 1,
                    range: { min: 0, max: 1 },
                    format: {
                        to: val => val == 1 ? 'benar' : 'salah',
                        from: val => val === 'benar' ? 1 : 0
                    },
                    tooltips: [true]
                });

                slider{{ $no }}.noUiSlider.on('update', function (values, handle) {
                    input{{ $no }}.value = values[handle];
                });
            }
        @endforeach
    });
</script>
@endpush
