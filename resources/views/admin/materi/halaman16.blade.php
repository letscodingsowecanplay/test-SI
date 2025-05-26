@extends('layouts.master')

@section('content')
<div class="card bg-coklat">
    <div class="card-header">
        <h4 class="mb-0">Ayo Berlatih</h4>
    </div>
    <div class="card-body">
        <button onclick="toggleAudio(this)" 
                class="btn btn-sm btn-outline-dark bg-coklapbet text-white"
                data-id="index-1" data-playing="false">🔊</button>
        <audio id="audio-index-1" src="{{ asset('sounds/materi/hal16/1.mp3') }}"></audio>
        <p>Susunlah benda-benda berikut untuk mengukur suatu objek secara tepat menggunakan satuan tidak baku! <br>Petunjuk: <br>Klik benda yang disediakan sebagai satuan tidak baku. <br>Seret dan letakkan benda tersebut ke area dropzone pada objek yang akan diukur secara tepat dan sesuai.</p>

        @php
            // Penjelasan langsung di blade
            $penjelasan = [
                1 => [
                    'benar' => 'Tinggi guci yang diukur menggunakan pensil sebagai satuan tidak baku sudah tepat, karena jumlah pensil yang digunakan sesuai dengan tinggi objek.',
                    'salah' => 'Jawaban kurang tepat. Hitung kembali jumlah pensil yang digunakan untuk mengukur tinggi guci agar sesuai dengan objek pada gambar.'
                ],
                2 => [
                    'benar' => 'Patung bekantan mini sudah diukur dengan stik es krim secara tepat. Jumlah stik es krim yang disusun sama dengan tinggi patung pada gambar.',
                    'salah' => 'Jawaban kurang tepat. Pastikan jumlah stik es krim yang digunakan untuk mengukur patung sama dengan tinggi patung pada gambar.'
                ],
                3 => [
                    'benar' => 'Pengukuran miniatur tugu pal 17 dengan kotak sudah sesuai. Jumlah kotak yang digunakan sama dengan tinggi miniatur.',
                    'salah' => 'Jawaban kurang tepat. Silakan hitung ulang jumlah kotak yang digunakan agar sesuai dengan tinggi miniatur tugu pada gambar.'
                ],
                4 => [
                    'benar' => 'Kerupuk basah kapuas sudah diukur menggunakan penghapus secara akurat, jumlah penghapus sama dengan lebar objek pada gambar.',
                    'salah' => 'Jawaban kurang tepat. Perhatikan jumlah penghapus yang dibutuhkan untuk mengukur lebar kerupuk basah pada gambar.'
                ],
                5 => [
                    'benar' => 'Dodol asli kandangan sudah diukur dengan korek api secara benar. Jumlah korek api sesuai dengan panjang objek pada gambar.',
                    'salah' => 'Jawaban kurang tepat. Coba ulangi dan hitung jumlah korek api yang digunakan agar sama dengan panjang dodol pada gambar.'
                ],
            ];

            $soalList = [
                1 => ['gambar' => 'benda0.png', 'satuan' => 'pensil', 'keterangan' => 'Contoh Kain', 'jawaban' => 5, 'is_contoh' => false, 'orientasi' => 'vertikal', 'kalimat' => 'Ukur guci peninggalan zaman dahulu di Kalimantan menggunakan pensil sebagai satuan tidak baku untuk mengetahui tingginya.'],
                2 => ['gambar' => 'benda1.png', 'satuan' => 'stik-eskrim', 'keterangan' => 'Kain Sasirangan', 'jawaban' => 5, 'is_contoh' => false, 'orientasi' => 'vertikal', 'custom_class' => 'custom-drop-2', 'kalimat' =>'Ukur patung bekantan mini menggunakan stik es krim sebagai satuan tidak baku untuk mengetahui tingginya.'],
                3 => ['gambar' => 'benda2.png', 'satuan' => 'kotak', 'keterangan' => 'Miniatur Gedung', 'jawaban' => 4, 'is_contoh' => false, 'orientasi' => 'vertikal', 'custom_class' => 'custom-drop-3', 'kalimat' => 'Ukur miniatur tugu pal 17 menggunakan kotak sebagai satuan tidak baku untuk mengetahui tingginya.'],
                4 => ['gambar' => 'benda3.png', 'satuan' => 'penghapus', 'keterangan' => 'Patung Bekantan', 'jawaban' => 7, 'is_contoh' => false, 'orientasi' => 'horizontal', 'custom_class' => 'custom-drop-4', 'kalimat' => 'Ukur kerupuk basah kapuas menggunakan penghapus sebagai satuan tidak baku untuk mengetahui lebarnya. '],
                5 => ['gambar' => 'benda4.png', 'satuan' => 'korek-api', 'keterangan' => 'Miniatur Rumah', 'jawaban' => 7, 'is_contoh' => false, 'orientasi' => 'horizontal', 'custom_class' => 'custom-drop-5', 'kalimat' => 'Ukur dodol asli kandangan menggunakan korek api sebagai satuan tidak baku untuk mengetahui lebarnya. '],
            ];
        @endphp

        <form action="{{ route('admin.materi.halaman16.simpan') }}" method="POST" id="kuisForm">
            @csrf

            @foreach($soalList as $no => $soal)
                <button 
                    type="button" 
                    onclick="toggleAudio(this)" 
                    class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2" 
                    title="Dengarkan"
                    data-id="hal16-{{ $no }}" 
                    data-playing="false">
                    🔊
                </button>
                <audio id="audio-hal16-{{ $no }}" src="{{ asset('sounds/materi/hal16/hal16-' . $no . '.mp3') }}"></audio>

                <div class="mb-3">
                    <strong>{{ $no }}. {{ $soal['kalimat'] }}</strong>
                </div>
                <div class="mb-5 text-center">
                    <div class="gambar-wrapper">
                        <img src="{{ asset('images/materi/ayo-berlatih-3/' . $soal['gambar']) }}" class="gambar-soal">
                        <div class="drop-zone {{ $soal['orientasi'] }} {{ $soal['custom_class'] ?? '' }} {{ $soal['is_contoh'] ? 'disabled' : '' }}"
                             id="drop-area-{{ $no }}"
                             data-soal="{{ $no }}"
                             data-max="{{ $soal['jawaban'] }}"
                             data-orientasi="{{ $soal['orientasi'] }}">
                            @if($soal['is_contoh'])
                                @for($j = 0; $j < $soal['jawaban']; $j++)
                                    <img src="{{ asset('images/materi/ayo-berlatih-3/' . $soal['satuan'] . '.png') }}" class="alat-satuan shadow mb-1" draggable="false">
                                @endfor
                            @elseif($sudahMenjawab && isset($jawabanUser['soal'.$no]))
                                @php
                                    $userCount = (int) $jawabanUser['soal'.$no];
                                    $kunciCount = (int) $soal['jawaban'];
                                    $selisih = $kunciCount - $userCount;
                                @endphp
                                @for($j = 0; $j < $userCount; $j++)
                                    <img src="{{ asset('images/materi/ayo-berlatih-3/' . $soal['satuan'] . '.png') }}"
                                         class="alat-satuan shadow mb-1"
                                         draggable="false"
                                         style="{{ ($userCount === $kunciCount) ? 'border:2px solid #4caf50;' : ($userCount !== $kunciCount ? 'border:2px solid #e53935;' : '') }}">
                                @endfor
                                @if(isset($status) && $status === 'lulus' && $userCount < $kunciCount)
                                    @for($k = 0; $k < $selisih; $k++)
                                        <img src="{{ asset('images/materi/ayo-berlatih-3/' . $soal['satuan'] . '.png') }}"
                                             class="alat-satuan shadow mb-1 opacity-50"
                                             draggable="false"
                                             style="border:2px dashed #4caf50;">
                                    @endfor
                                @endif
                            @endif
                        </div>
                    </div>
                    <input type="hidden" name="jawaban[soal{{ $no }}]" id="jawabanDrop{{ $no }}" value="{{ $soal['is_contoh'] ? $soal['jawaban'] : ($jawabanUser['soal'.$no] ?? '') }}">

                    @if(!$sudahMenjawab && !$soal['is_contoh'])
                    <div class="text-center mb-2">
                        <p><strong>Satuan: {{ ucfirst($soal['satuan']) }}</strong></p>
                        <div class="satuan-area" id="satuan-area-{{ $no }}">
                            @for($i = 1; $i <= 10; $i++)
                                <div class="satuan-slot" data-slot="{{ $i }}">
                                    <img src="{{ asset('images/materi/ayo-berlatih-3/' . $soal['satuan'] . '.png') }}" 
                                         class="alat-satuan shadow mb-1"
                                         draggable="true"
                                         id="alat-{{ $no }}-{{ $i }}"
                                         data-soal="{{ $no }}"
                                         data-index="{{ $i }}">
                                </div>
                            @endfor
                        </div>
                    </div>
                    @endif

                    @if(!$soal['is_contoh'] && $sudahMenjawab)
                        <div class="text-center mt-3">
                            <strong>Jawaban kamu:</strong> {{ $jawabanUser['soal'.$no] ?? '-' }} satuan<br>
                            @if(isset($status) && $status === 'lulus')
                                <strong>Kunci Jawaban:</strong> {{ $soal['jawaban'] }} satuan
                            @endif
                        </div>
                        @php
                            $userJawab = (int) ($jawabanUser['soal'.$no] ?? 0);
                            $kunciJawab = (int) $soal['jawaban'];
                            $benar = ($userJawab === $kunciJawab);
                        @endphp
                        <div class="explain-alert mt-2 mx-auto" style="max-width: 480px; border-radius:10px; padding:15px; font-weight:500; border:2px solid {{ $benar ? '#47cc69' : '#e74c3c' }}; background:{{ $benar ? '#eafaf3' : '#fff5f5' }}; color:{{ $benar ? '#169652' : '#b22727' }};">
                            {!! $benar ? $penjelasan[$no]['benar'] : $penjelasan[$no]['salah'] !!}
                        </div>
                    @endif
                </div>
            @endforeach

            @if(!$sudahMenjawab)
                <div class="text-end">
                    <button type="submit" class="btn bg-coklap2 text-white">Kirim Jawaban</button>
                </div>
            @endif
        </form>

        @if($sudahMenjawab && $status === 'tidak_lulus')
            <form action="{{ route('admin.materi.halaman16.reset') }}" method="POST" class="mt-3">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Ulangi Kuis</button>
            </form>
            <div class="alert alert-warning mt-3">Nilai kamu belum mencapai KKM. Silakan ulangi kuis ini.</div>
        @elseif($sudahMenjawab && $status === 'lulus')
            <div class="text-center flex-grow-1">
                <div class="alert alert-info d-inline-block mb-0">
                    Skor Anda: {{ round($skor, 2) }} / {{ count($soalList) }}
                </div>
            </div><br>
            <div class="alert alert-success mt-3">Selamat, kamu telah mencapai KKM. Kamu boleh melanjutkan ke halaman berikutnya.</div>
        @endif
    </div>

    <div class="card-footer d-flex justify-content-between align-items-center">
        <a href="{{ route('admin.materi.halaman15') }}" class="btn bg-coklap2 text-white">← Sebelumnya</a>
        @if($sudahMenjawab && $status === 'lulus')
            <a href="{{ route('admin.evaluasi.petunjuk') }}" class="btn bg-coklap1 text-white">Selanjutnya →</a>
        @else
            <button class="btn bg-coklap1 text-white disabled">Selanjutnya →</button>
        @endif
    </div>
</div>
<br>
@endsection


@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    let dragged = null;
    let draggedSlot = null;

    document.querySelectorAll('.alat-satuan[draggable="true"]').forEach(function (el) {
        el.addEventListener('dragstart', function (e) {
            dragged = el;
            draggedSlot = el.parentNode;
            setTimeout(() => { el.style.visibility = "hidden"; }, 1);
        });
        el.addEventListener('dragend', function (e) {
            if (dragged) dragged.style.visibility = "visible";
            dragged = null;
            draggedSlot = null;
        });
    });

    document.querySelectorAll('.drop-zone').forEach(function (zone) {
        const soalId = zone.dataset.soal;
        const orientasi = zone.dataset.orientasi; // 'vertikal' atau 'horizontal'
        const inputField = document.getElementById('jawabanDrop' + soalId);
        const maxItems = parseInt(zone.getAttribute('data-max'), 10);

        if (zone.classList.contains('disabled')) return;

        zone.addEventListener('dragover', function (e) {
            e.preventDefault();
        });

        zone.addEventListener('drop', function (e) {
            e.preventDefault();
            if (!dragged) return;
            if (dragged.getAttribute('data-soal') !== soalId) return;

            // Hitung hanya img asli
            const count = zone.querySelectorAll('img.alat-satuan:not(.opacity-50)').length;
            if (count >= maxItems) return;

            // Hapus dari satuan-area: ganti slot jadi kosong
            if (draggedSlot && draggedSlot.classList.contains('satuan-slot')) {
                draggedSlot.innerHTML = '';
                draggedSlot.classList.add('empty');
            }

            // Clone dan letakkan di dropzone urutan benar
            let clone = dragged.cloneNode(true);
            clone.removeAttribute('id');
            clone.setAttribute('draggable', false);
            clone.classList.add('mb-1');
            clone.style.visibility = "visible";

            // Vertikal: appendChild (urutan dari bawah ke atas), Horizontal: appendChild (kiri ke kanan)
            zone.appendChild(clone);

            // Update input hidden
            if (inputField) inputField.value = count + 1;
        });
    });
});
let currentAudio = null;
let currentButton = null;
function toggleAudio(button) {
    const id = button.getAttribute('data-id');
    const audio = document.getElementById(`audio-${id}`);
    document.querySelectorAll('audio').forEach(a => {
        if (a !== audio) {
            a.pause();
            a.currentTime = 0;
        }
    });
    document.querySelectorAll('button[data-id]').forEach(btn => {
        if (btn !== button) {
            btn.innerText = '🔊';
            btn.setAttribute('data-playing', 'false');
        }
    });
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
    audio.onended = function () {
        button.innerText = '🔊';
        button.setAttribute('data-playing', 'false');
    };
}
</script>
@endpush
