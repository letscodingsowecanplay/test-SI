@extends('layouts.master')

@section('content')
<div class="card bg-coklat fs-5">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Ayo Mencoba</h4>
    </div>

    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @php
            $soalList = [
                1 => 'Badik Ashu yang memiliki bentuk lebih panjang adalah ...',
                2 => 'Guci peninggalan zaman dahulu di Kalimantan yang memiliki bentuk lebih tinggi adalah ...',
                3 => 'Dayung kelotok yang memiliki bentuk lebih panjang adalah ...',
                4 => 'Mandau Kalimantan yang tergantung pada posisi lebih rendah adalah ...'
            ];

            $gambarList = [
                1 => 'soal1.png',
                2 => 'soal2.png',
                3 => 'soal3.png',
                4 => 'soal4.png'
            ];

            // Penjelasan jawaban tiap soal
            $penjelasan = [
                1 => [
                    'a' => 'Jawaban kamu benar. Badik Ashu A memang lebih panjang di antara pilihan.',
                    'b' => 'Jawaban kamu salah. Badik Ashu A lebih pendek daripada B.'
                ],
                2 => [
                    'a' => 'Jawaban kamu benar. Guci A adalah yang lebih tinggi dibandingkan yang lain.',
                    'b' => 'Jawaban kamu salah. Guci B tidak lebih tinggi dari A.'
                ],
                3 => [
                    'a' => 'Jawaban kamu benar. Dayung kelotok A yang lebih panjang.',
                    'b' => 'Jawaban kamu salah. Dayung kelotok B lebih pendek daripada A.'
                ],
                4 => [
                    'a' => 'Jawaban kamu benar. Mandau A tergantung di posisi lebih rendah.',
                    'b' => 'Jawaban kamu salah. Mandau B posisinya tidak lebih rendah dari A.'
                ],
            ];
        @endphp

        <form id="kuisForm" action="{{ route('admin.materi.halaman9.simpan') }}" method="POST">
            @csrf

            {{-- Contoh Soal --}}
            <div class="mb-5">
                <h5><strong>Contoh Soal</strong>
                    <button onclick="toggleAudio(this)" 
                            class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2"
                            data-id="index-1" data-playing="false">🔊</button>
                    <audio id="audio-index-1" src="{{ asset('sounds/materi/hal9/1.mp3') }}"></audio>
                </h5>
                <p>
                    Amati gambar berikut dengan saksama! Jawablah pertanyaan di bawah ini dengan menyeret dan meletakkan pilihan jawaban yang sesuai.
                </p>
                <p>
                    Kain Sasirangan yang memiliki bentuk lebih pendek adalah ....
                    <button onclick="toggleAudio(this)" 
                            class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2"
                            data-id="index-2" data-playing="false">🔊</button>
                    <audio id="audio-index-2" src="{{ asset('sounds/materi/hal9/2.mp3') }}"></audio>
                </p>

                <div class="text-center mb-3">
                    <img src="{{ asset('images/materi/ayo-mencoba-2/contoh.png') }}" class="img-fluid rounded shadow" style="max-width: 600px;">
                </div>

                <div class="d-flex flex-wrap justify-content-center gap-2 mb-3">
                    <div class="block-option bg-light text-dark d-inline-block px-3 py-2 rounded border" draggable="false">
                        a
                    </div>
                    <div class="block-option bg-light text-dark d-inline-block px-3 py-2 rounded border" draggable="false">
                        b
                    </div>
                </div>

                <div class="drop-area-style text-center mb-4">
                    <p class="text-muted mb-1">Jawaban yang benar:</p>
                    <div class="block-option bg-success text-white d-inline-block px-3 py-2 rounded">
                        a
                    </div>
                </div>

                <p>
                    Penyelesaian: <br> Ketika dibandingkan dengan saksama antara kain Sasirangan A dan B, terlihat bahwa kain Sasirangan A memiliki bentuk yang lebih pendek dibandingkan dengan kain Sasirangan B. Oleh karena itu, jawabannya adalah A.
                </p>
            </div>
            <hr>
            <h5><strong>Ayo Mencoba</strong>
                    <button onclick="toggleAudio(this)" 
                            class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2"
                            data-id="index-3" data-playing="false">🔊</button>
                    <audio id="audio-index-3" src="{{ asset('sounds/materi/hal9/3.mp3') }}"></audio>
            </h5>
            <p>
                Amati gambar berikut dengan saksama! Jawablah pertanyaan di bawah ini dengan menyeret dan meletakkan pilihan jawaban yang sesuai.
            </p>

            {{-- Soal --}}
            @foreach($soalList as $no => $teks)
                @php
                    $key = 'soal' . $no;
                    $userJawaban = $jawabanUser[$key] ?? null;
                    $kunci = $kunciJawaban[$key] ?? null;
                    $benar = ($userJawaban && $userJawaban === $kunci);
                @endphp

                <div class="mb-4">
                    <div class="d-flex align-items-center mb-2">
                        <p class="mb-0"><strong>{{ $no }}. </strong> {{ $teks }}</p>
                        <button 
                            type="button" 
                            onclick="toggleAudio(this)" 
                            class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2" 
                            title="Dengarkan"
                            data-id="hal9-{{ $no }}" 
                            data-playing="false">
                            🔊
                        </button>
                        <audio id="audio-hal9-{{ $no }}" src="{{ asset('sounds/materi/hal9/hal9-' . $no . '.mp3') }}"></audio>
                    </div>
                    <div class="text-center mb-3">
                        <img src="{{ asset('images/materi/ayo-mencoba-2/' . $gambarList[$no]) }}" class="img-fluid rounded shadow" style="max-width: 600px;">
                    </div>

                    @if(!$sudahMenjawab)
                        <div class="d-flex flex-wrap justify-content-center gap-2 mb-3">
                            <div class="block-option" draggable="true" id="option-{{ $no }}-a" data-soal="{{ $no }}">a</div>
                            <div class="block-option" draggable="true" id="option-{{ $no }}-b" data-soal="{{ $no }}">b</div>
                        </div>
                        <div class="drop-area-style text-center mb-4" id="drop-area-{{ $no }}" data-soal="{{ $no }}">
                            <p class="text-muted">Seret jawaban ke sini</p>
                            <input type="hidden" name="jawaban[{{ $key }}]" id="jawabanDrop{{ $no }}" required>
                        </div>
                    @else
                        <div class="drop-area-style text-center mb-3">
                            @if($userJawaban)
                                <div class="block-option {{ $benar ? 'bg-success' : 'bg-danger' }} text-white d-inline-block px-3 py-2 rounded" style="cursor: default;" draggable="false">
                                    {{ $userJawaban }}
                                </div>
                            @else
                                <div class="text-muted">Belum dijawab</div>
                            @endif
                        </div>
                    @endif

                    {{-- Penjelasan jawaban --}}
                    @if($sudahMenjawab && $userJawaban)
                        <div class="card card-body border-info bg-light mt-2">
                            @php
                                $isCorrect = $userJawaban === $kunci;
                                $explain = $penjelasan[$no][$isCorrect ? 'a' : 'b'] ?? 'Kamu belum memilih jawaban atau belum ada penjelasan.';
                            @endphp
                            {!! $explain !!}
                            @if($status === 'lulus')
                                <hr>
                                <span class="text-success">
                                    <strong>Kunci Jawaban:</strong> {{ $kunci }}
                                </span>
                            @endif
                        </div>
                    @endif
                </div>
            @endforeach

            @if(!$sudahMenjawab)
                <div class="text-end">
                    <button type="submit" class="btn bg-coklap2 text-white fs-5">Kirim Jawaban</button>
                </div>
            @endif
        </form>

        @if($sudahMenjawab && $status === 'tidak_lulus')
            <form action="{{ route('admin.materi.halaman9.reset') }}" method="POST" class="text-center mt-2">
                @csrf
                <button type="submit" class="btn btn-danger fs-5">Ulangi Kuis</button>
            </form>
            <div class="alert alert-warning text-center mt-3">
                Nilai kamu belum mencapai KKM. Silakan ulangi kuis ini.
            </div>
        @elseif($sudahMenjawab && $status === 'lulus')
            <br><div class="text-center flex-grow-1">
                <div class="alert alert-info d-inline-block mb-0">
                    Nilai Anda: {{ $skor }} / 100
                </div>
            </div><br>
            <div class="alert alert-success mt-3">
                Selamat, kamu telah mencapai KKM. Kamu boleh melanjutkan ke halaman berikutnya.
            </div>
        @endif
    </div>

    <div class="card-footer d-flex justify-content-between align-items-center">
        <a href="{{ route('admin.materi.halaman8') }}" class="btn bg-coklap2 text-white fs-5">← Sebelumnya</a>
        @if($sudahMenjawab && $status === 'lulus')
            <a href="{{ route('admin.materi.halaman10') }}" class="btn bg-coklap1 text-white fs-5">Selanjutnya →</a>
        @else
            <button class="btn bg-coklap2 text-white disabled fs-5">Selanjutnya →</button>
        @endif
    </div>
</div>
<br>
@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    const soalCount = 4;
    for (let i = 1; i <= soalCount; i++) {
        const dropArea = document.getElementById('drop-area-' + i);
        const jawabanDrop = document.getElementById('jawabanDrop' + i);

        ['a', 'b'].forEach(opt => {
            const dragItem = document.getElementById(`option-${i}-${opt}`);
            if (dragItem) {
                dragItem.addEventListener('dragstart', function (e) {
                    e.dataTransfer.setData('text/plain', this.id);
                    e.dataTransfer.setData('soal-no', this.dataset.soal);
                });
            }
        });

        if (dropArea) {
            dropArea.addEventListener('dragover', function (e) {
                e.preventDefault();
                dropArea.classList.add('highlight');
            });

            dropArea.addEventListener('dragleave', function () {
                dropArea.classList.remove('highlight');
            });

            dropArea.addEventListener('drop', function (e) {
                e.preventDefault();
                dropArea.classList.remove('highlight');

                const draggedId = e.dataTransfer.getData('text/plain');
                const draggedSoal = e.dataTransfer.getData('soal-no');
                const targetSoal = dropArea.dataset.soal;

                if (draggedSoal !== targetSoal) return;

                const dragged = document.getElementById(draggedId);
                const clone = dragged.cloneNode(true);
                clone.setAttribute('draggable', false);
                clone.classList.add('mt-2');

                dropArea.querySelectorAll('.block-option').forEach(el => el.remove());
                dropArea.appendChild(clone);

                if (jawabanDrop) {
                    const value = draggedId.endsWith('-a') ? 'a' : 'b';
                    jawabanDrop.value = value;
                }
            });
        }
    }
});
    let currentAudio = null;
    let currentButton = null;

    function toggleAudio(button) {
        const id = button.getAttribute('data-id');
        const audio = document.getElementById(`audio-${id}`);

        // Hentikan semua audio lain
        document.querySelectorAll('audio').forEach(a => {
            if (a !== audio) {
                a.pause();
                a.currentTime = 0;
            }
        });

        // Reset semua tombol lain
        document.querySelectorAll('button[data-id]').forEach(btn => {
            if (btn !== button) {
                btn.innerText = '🔊';
                btn.setAttribute('data-playing', 'false');
            }
        });

        // Play/pause toggle
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

        // Saat audio selesai
        audio.onended = function () {
            button.innerText = '🔊';
            button.setAttribute('data-playing', 'false');
        };
    }
</script>
@endpush
