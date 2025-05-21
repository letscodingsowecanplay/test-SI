@extends('layouts.master')

@section('content')
<div class="card bg-coklat">
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
                1 => 'Badik Ashu yang memiliki bentuk paling panjang adalah ...',
                2 => 'Guci peninggalan zaman dahulu di Kalimantan yang memiliki bentuk paling tinggi adalah ...',
                3 => 'Dayung kelotok yang memiliki bentuk paling panjang adalah ...',
                4 => 'JMandau Kalimantan yang tergantung pada posisi paling rendah adalah ...'
            ];

            $gambarList = [
                1 => 'soal1.png',
                2 => 'soal2.png',
                3 => 'soal3.png',
                4 => 'soal4.png'
            ];
        @endphp

        <form id="kuisForm" action="{{ route('admin.materi.halaman9.simpan') }}" method="POST">
            @csrf

            {{-- Contoh Soal --}}
            <div class="mb-5">
                <h5><strong>Contoh Soal</strong>
                    <button type="button" onclick="document.getElementById('audioContoh').play()" class="btn btn-sm bg-coklapbet text-white ms-2">🔊</button>
                    <audio id="audioContoh" src="{{ asset('audio/materi/hal9_soal0.mp3') }}"></audio>
                </h5>
                <p>
                    Amati gambar berikut dengan saksama! Jawablah pertanyaan di bawah ini dengan menyeret dan meletakkan pilihan jawaban yang sesuai.
                </p>
                <p>
                    Kain Sasirangan yang memiliki bentuk paling pendek adalah ....
                    <button type="button" onclick="document.getElementById('audioContoh').play()" class="btn btn-sm bg-coklapbet text-white ms-2">🔊</button>
                    <audio id="audioContoh" src="{{ asset('audio/materi/hal9_soal0.mp3') }}"></audio>
                </p>

                <div class="text-center mb-3">
                    <img src="{{ asset('images/materi/ayo-mencoba-2/contoh.png') }}" class="img-fluid rounded shadow" style="max-width: 600px;">
                </div>

                <div class="d-flex flex-wrap justify-content-center gap-2 mb-3">
                    <div class="block-option bg-light text-dark d-inline-block px-3 py-2 rounded border" draggable="false">
                        a (kiri)
                    </div>
                    <div class="block-option bg-light text-dark d-inline-block px-3 py-2 rounded border" draggable="false">
                        b (kanan)
                    </div>
                </div>

                <div class="drop-area-style text-center mb-4">
                    <p class="text-muted mb-1">Jawaban yang benar:</p>
                    <div class="block-option bg-success text-white d-inline-block px-3 py-2 rounded">
                        a (kiri)
                    </div>
                </div>

                <p>
                    Penyelesaian: <br> Ketika dibandingkan dengan saksama antara kain Sasirangan A dan B, terlihat bahwa kain Sasirangan A memiliki bentuk yang lebih pendek dibandingkan dengan kain Sasirangan B. Oleh karena itu, jawabannya adalah A.
                </p>
            </div>
            <hr>
            <h5><strong>Ayo Mencoba</strong>
                <button type="button" onclick="document.getElementById('audioContoh').play()" class="btn btn-sm bg-coklapbet text-white ms-2">🔊</button>
                <audio id="audioContoh" src="{{ asset('audio/materi/hal9_soal0.mp3') }}"></audio>
            </h5>
            <p>
                Amati gambar berikut dengan saksama! Jawablah pertanyaan di bawah ini dengan menyeret dan meletakkan pilihan jawaban yang sesuai.
            </p>

            {{-- Soal --}}
            @foreach($soalList as $no => $teks)
                @php
                    $key = 'soal' . $no;
                    $userJawaban = $jawabanUser[$key] ?? null;
                    $jawabanLabel = $userJawaban === 'a' ? 'a (kiri)' : ($userJawaban === 'b' ? 'b (kanan)' : '-');
                    $kunci = $kunciJawaban[$key] ?? '-';
                @endphp

                <div class="mb-4">
                    <div class="d-flex align-items-center mb-2">
                        <p class="mb-0"><strong>{{ $no }}. </strong> {{ $teks }}</p>
                        <button type="button" onclick="document.getElementById('audio{{ $no }}').play()" class="btn btn-sm bg-coklapbet text-white ms-2">🔊</button>
                        <audio id="audio{{ $no }}" src="{{ asset('audio/materi/hal9_soal'.$no.'.mp3') }}"></audio>
                    </div>
                    <div class="text-center mb-3">
                        <img src="{{ asset('images/materi/ayo-mencoba-2/' . $gambarList[$no]) }}" class="img-fluid rounded shadow" style="max-width: 600px;">
                    </div>

                    @if(!$sudahMenjawab)
                        <div class="d-flex flex-wrap justify-content-center gap-2 mb-3">
                            <div class="block-option" draggable="true" id="option-{{ $no }}-a" data-soal="{{ $no }}">a (kiri)</div>
                            <div class="block-option" draggable="true" id="option-{{ $no }}-b" data-soal="{{ $no }}">b (kanan)</div>
                        </div>
                        <div class="drop-area-style text-center mb-4" id="drop-area-{{ $no }}" data-soal="{{ $no }}">
                            <p class="text-muted">Seret jawaban ke sini</p>
                            <input type="hidden" name="jawaban[{{ $key }}]" id="jawabanDrop{{ $no }}" required>
                        </div>
                    @else
                        <div class="drop-area-style text-center mb-3">
                            @if($userJawaban)
                                <div class="block-option bg-secondary text-white d-inline-block px-3 py-2 rounded" style="cursor: default;" draggable="false">
                                    {{ $jawabanLabel }}
                                </div>
                            @else
                                <div class="text-muted">Belum dijawab</div>
                            @endif
                        </div>

                        <div class="text-center mb-4">
                            <div class="block-option {{ $userJawaban === $kunci ? 'bg-success' : 'bg-danger' }} text-white d-inline-block px-3 py-2 rounded">
                                Jawaban kamu: {{ $userJawaban ?? '-' }}
                            </div>
                            @if($status === 'lulus')
                                <div class="mt-2 text-muted">
                                    Kunci Jawaban: {{ $kunci }}
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            @endforeach

            @if(!$sudahMenjawab)
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Kirim Jawaban</button>
                </div>
            @endif
        </form>

        @if($sudahMenjawab && $status === 'tidak_lulus')
            <form action="{{ route('admin.materi.halaman9.reset') }}" method="POST" class="text-center mt-2">
                @csrf
                <button type="submit" class="btn btn-danger">Ulangi Kuis</button>
            </form>
            <div class="alert alert-warning text-center mt-3">
                Nilai kamu belum mencapai KKM. Silakan ulangi kuis ini.
            </div>
        @elseif($sudahMenjawab && $status === 'lulus')
            <div class="alert alert-success text-center mt-4">
                Selamat, kamu telah mencapai KKM! Skor kamu: {{ $skor }}/4
            </div>
        @endif
    </div>

    <div class="card-footer d-flex justify-content-between align-items-center">
        <a href="{{ route('admin.materi.halaman8') }}" class="btn btn-secondary">← Sebelumnya</a>
        @if($sudahMenjawab && $status === 'lulus')
            <a href="{{ route('admin.materi.halaman10') }}" class="btn btn-success">Selanjutnya →</a>
        @else
            <button class="btn btn-success disabled">Selanjutnya →</button>
        @endif
    </div>
</div>
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
</script>
@endpush
