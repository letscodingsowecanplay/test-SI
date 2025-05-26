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
            <h5>Contoh Soal         
                <button onclick="toggleAudio(this)" 
                        class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2"
                        data-id="index-1" data-playing="false">🔊</button>
                <audio id="audio-index-1" src="{{ asset('sounds/materi/hal15/1.mp3') }}"></audio>
            </h5>
            <p>Amati video berikut dengan saksama!</p>

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

                <button onclick="toggleAudio(this)" 
                        class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2"
                        data-id="index-2" data-playing="false">🔊</button>
                <audio id="audio-index-2" src="{{ asset('sounds/materi/hal15/2.mp3') }}"></audio>

                <p>
                    Setelah menyimak video, perhatikan pertanyaan berikut dan tentukan apakah pernyataan tersebut Benar atau Salah dengan menggeser slider pada pilihan jawaban.</p>
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
            <p>Penyelesaian: <br>Berdasarkan isi video, pernyataan yang diberikan sesuai dengan informasi yang ditampilkan. Oleh karena itu, jawaban yang benar adalah Benar.</p>
        </div>
        <hr>
        <h5>Ayo Mencoba         
            <button onclick="toggleAudio(this)" 
                    class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2"
                    data-id="index-3" data-playing="false">🔊</button>
            <audio id="audio-index-3" src="{{ asset('sounds/materi/hal15/3.mp3') }}"></audio>
        </h5>
        
        <p>Amati gambar berikut dengan saksama! Tentukan apakah pernyataan tersebut Benar atau Salah dengan menggeser slider pada pilihan jawaban.</p>

        @php
            // Sesuaikan urutan dan number agar tidak ambigu dengan $kunci
            $soal = [
                1 => ['gambar' => 'soal1.png', 'teks' => 'Tinggi wadai cincin setara dengan 3 stik es krim.'],
                2 => ['gambar' => 'soal2.png', 'teks' => 'Panjang diameter buah asam payak setara dengan 1 koin.'],
                3 => ['gambar' => 'soal3.png', 'teks' => 'Panjang buah ulin setara dengan 9 kotak.'],
                4 => ['gambar' => 'soal4.png', 'teks' => 'Panjang tempat penyimpanan gaharu setara dengan 1 pensil.'],
            ];

            // Penjelasan: kunci jawaban 'benar'/'salah' (text harus konsisten sesuai instruksi)
            $penjelasan = [
                1 => [
                    'benar' => 'Jawaban benar. Tinggi wadai cincin memang tidak setara dengan 3 stik es krim.',
                    'salah' => 'Jawaban kurang tepat. Tinggi wadai cincin pada gambar tidak sama dengan 3 stik es krim.'
                ],
                2 => [
                    'benar' => 'Jawaban benar. Diameter buah asam payak pada gambar tepat sama dengan 1 koin.',
                    'salah' => 'Jawaban kurang tepat. Diameter buah asam payak sebenarnya tepat sama dengan 1 koin.'
                ],
                3 => [
                    'benar' => 'Jawaban benar. Panjang buah ulin di gambar tidak setara dengan 9 kotak.',
                    'salah' => 'Jawaban kurang tepat. Panjang buah ulin pada gambar tidak setara dengan 9 kotak.'
                ],
                4 => [
                    'benar' => 'Jawaban benar. Panjang tempat penyimpanan gaharu pada gambar sama dengan 1 pensil.',
                    'salah' => 'Jawaban kurang tepat. Panjang tempat penyimpanan gaharu sebenarnya sama dengan 1 pensil.'
                ]
            ];
        @endphp

        <form action="{{ route('admin.materi.halaman15.simpan') }}" method="POST" id="kuisForm">
            @csrf

            @foreach($soal as $no => $data)
                <div class="mb-5">
                    <p>
                        {{ $no }}. {{ $data['teks'] }}
                        <button 
                            type="button" 
                            onclick="toggleAudio(this)" 
                            class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2"
                            title="Dengarkan"
                            data-id="hal15-{{ $no }}"
                            data-playing="false">
                            🔊
                        </button>
                        <audio id="audio-hal15-{{ $no }}" src="{{ asset('sounds/materi/hal15/hal15-' . $no . '.mp3') }}"></audio>
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
                        @php
                            // Jawaban user & kunci
                            $userJawab = $jawabanUser['soal'.$no] ?? null;
                            $kunciJawab = $kunci['soal'.$no] ?? null;
                            $isCorrect = $userJawab === $kunciJawab;
                            // Tampilkan penjelasan sesuai hasil perbandingan (bukan berdasarkan kunci saja)
                            $explain = $isCorrect ? $penjelasan[$no]['benar'] : $penjelasan[$no]['salah'];
                        @endphp
                        <div class="text-center mb-2">
                            Jawaban kamu: <strong>{{ ucfirst($userJawab ?? '-') }}</strong>
                            @if($skor >= $kkm)
                                <span class="ms-3">Kunci Jawaban: <strong>{{ ucfirst($kunciJawab) }}</strong></span>
                            @endif
                        </div>
                        @if($userJawab)
                            <div class="card card-body mt-2"
                                style="border:2px solid {{ $isCorrect ? '#47cc69' : '#e74c3c' }}; background:{{ $isCorrect ? '#eafaf3' : '#fff5f5' }}; color:{{ $isCorrect ? '#169652' : '#b22727' }};">
                                {!! $explain !!}
                            </div>
                        @else
                            <em>Kamu belum memilih jawaban untuk soal ini.</em>
                        @endif
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
            <form action="{{ route('admin.materi.halaman15.reset') }}" method="POST" class="mt-3">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Ulangi Kuis</button>
            </form>
            <div class="alert alert-warning mt-3">
                Nilai kamu belum mencapai KKM. Silakan ulangi kuis ini.
            </div>
        @elseif($sudahMenjawab && $skor >= $kkm)
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

    <div class="card-footer d-flex justify-content-between">
        <a href="{{ route('admin.materi.halaman14') }}" class="btn bg-coklap2 text-white">← Sebelumnya</a>
        @if($sudahMenjawab && $skor >= $kkm)
            <a href="{{ route('admin.materi.halaman16') }}" class="btn bg-coklap1 text-white">Selanjutnya →</a>
        @else
            <button class="btn bg-coklap1 text-white disabled">Selanjutnya →</button>
        @endif
    </div>
</div>
<br>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/nouislider@15.6.1/dist/nouislider.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // CONTOH, hanya fake slider: sudah fix jawaban
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
                if (inputContoh.value !== 'benar' && tries < 10) {
                    setTimeout(() => forceSliderRight(tries + 1), 500);
                } else {
                    sliderContoh.style.pointerEvents = 'none';
                    sliderContoh.style.opacity = '0.6';
                }
            }
            forceSliderRight();
        }

        // Untuk soal siswa
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

        // Reset ikon tombol lainnya
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
@endpush
