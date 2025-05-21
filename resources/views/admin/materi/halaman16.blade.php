@extends('layouts.master')

@section('content')
<div class="card bg-coklat">
    <div class="card-header">
        <h4 class="mb-0">Ayo Berlatih</h4>
    </div>
    <div class="card-body">
        <p>Susunlah benda-benda berikut untuk mengukur suatu objek secara tepat menggunakan satuan tidak baku! Petunjuk: <br>Klik benda yang disediakan sebagai satuan tidak baku. <br>Seret dan letakkan benda tersebut ke area dropzone pada objek yang akan diukur secara tepat dan sesuai.</p>

        @php
            $soalList = [
                1 => ['gambar' => 'benda0.png', 'satuan' => 'pensil', 'keterangan' => 'Contoh Kain', 'jawaban' => 5, 'is_contoh' => false, 'orientasi' => 'vertikal', 'kalimat' => 'Ukur guci peninggalan zaman dahulu di Kalimantan menggunakan pensil sebagai satuan tidak baku untuk mengetahui tingginya.'],
                2 => ['gambar' => 'benda1.png', 'satuan' => 'stik-eskrim', 'keterangan' => 'Kain Sasirangan', 'jawaban' => 5, 'is_contoh' => false, 'orientasi' => 'vertikal', 'custom_class' => 'custom-drop-2', 'kalimat' =>'Ukur patung bekantan mini menggunakan stik eskrim sebagai satuan tidak baku untuk mengetahui tingginya.'],
                3 => ['gambar' => 'benda2.png', 'satuan' => 'kotak', 'keterangan' => 'Miniatur Gedung', 'jawaban' => 4, 'is_contoh' => false, 'orientasi' => 'vertikal', 'custom_class' => 'custom-drop-3', 'kalimat' => 'Ukur miniatur tugu pal 17 menggunakan kotak sebagai satuan tidak baku untuk mengetahui tingginya.'],
                4 => ['gambar' => 'benda3.png', 'satuan' => 'penghapus', 'keterangan' => 'Patung Bekantan', 'jawaban' => 7, 'is_contoh' => false, 'orientasi' => 'horizontal', 'custom_class' => 'custom-drop-4', 'kalimat' => 'Ukur kerupuk basah kapuas menggunakan kotak sebagai satuan tidak baku untuk mengetahui lebarnya. '],
                5 => ['gambar' => 'benda4.png', 'satuan' => 'korek-api', 'keterangan' => 'Miniatur Rumah', 'jawaban' => 7, 'is_contoh' => false, 'orientasi' => 'horizontal', 'custom_class' => 'custom-drop-5', 'kalimat' => 'Ukur dodol asli kandangan menggunakan kotak sebagai satuan tidak baku untuk mengetahui lebarnya. '],
            ];

            
        @endphp

        <form action="{{ route('admin.materi.halaman16.simpan') }}" method="POST" id="kuisForm">
            @csrf

            @foreach($soalList as $no => $soal)
                <div class="">
                    <button onclick="document.getElementById('audioSoal{{ $no }}').play()" type="button" class="btn btn-sm bg-coklapbet text-white">🔊</button>
                    <audio id="audioSoal{{ $no }}" src="{{ asset('audio/materi/hal16_soal'.$no.'.mp3') }}"></audio>
                </div>
                {{-- Tambahkan kalimat soal di atas gambar --}}
                <div class="mb-3">
                    <strong>{{ $no }}. {{ $soal['kalimat'] }}</strong>
                </div>
                <div class="mb-5 text-center">
                    <div class="position-relative d-inline-block">
                        <div class="gambar-wrapper">
                            <img src="{{ asset('images/materi/ayo-berlatih-3/' . $soal['gambar']) }}" class="gambar-soal">
                            <div class="drop-zone {{ $soal['orientasi'] }} {{ $soal['custom_class'] ?? '' }} {{ $soal['is_contoh'] ? 'disabled' : '' }}" id="drop-area-{{ $no }}" data-soal="{{ $no }}" data-max="{{ $soal['jawaban'] }}">
                                @if($soal['is_contoh'])
                                    @for($j = 0; $j < $soal['jawaban']; $j++)
                                        <img src="{{ asset('images/materi/ayo-berlatih-3/' . $soal['satuan'] . '.png') }}" class="alat-satuan shadow" draggable="false">
                                    @endfor
                                @elseif($sudahMenjawab && isset($jawabanUser['soal'.$no]))
                                    @php $userCount = (int) $jawabanUser['soal'.$no]; @endphp
                                    @for($j = 0; $j < $userCount; $j++)
                                        <img src="{{ asset('images/materi/ayo-berlatih-3/' . $soal['satuan'] . '.png') }}" class="alat-satuan shadow bg-warning-subtle" draggable="false">
                                    @endfor
                                    @if($status === 'lulus' && $userCount < $soal['jawaban'])
                                        @for($k = 0; $k < $soal['jawaban'] - $userCount; $k++)
                                            <img src="{{ asset('images/materi/ayo-berlatih-3/' . $soal['satuan'] . '.png') }}" class="alat-satuan shadow bg-success-subtle" draggable="false">
                                        @endfor
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="jawaban[soal{{ $no }}]" id="jawabanDrop{{ $no }}" value="{{ $soal['is_contoh'] ? $soal['jawaban'] : ($jawabanUser['soal'.$no] ?? '') }}">

                    @if(!$sudahMenjawab && !$soal['is_contoh'])
                    <div class="text-center mb-2">
                        <p><strong>Satuan: {{ ucfirst($soal['satuan']) }}</strong></p>
                        <div class="satuan-area">
                            @for($i = 1; $i <= 10; $i++)
                                <img src="{{ asset('images/materi/ayo-berlatih-3/' . $soal['satuan'] . '.png') }}" class="alat-satuan shadow" draggable="true" id="alat-{{ $no }}-{{ $i }}" data-soal="{{ $no }}">
                            @endfor
                        </div>
                    </div>
                    @endif

                    @if(!$soal['is_contoh'] && $sudahMenjawab)
                        <div class="text-center mt-3">
                            <strong>Jawaban kamu:</strong> {{ $jawabanUser['soal'.$no] ?? '-' }} satuan<br>
                            @if($status === 'lulus')
                                <strong>Kunci Jawaban:</strong> {{ $soal['jawaban'] }} satuan
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
            <form action="{{ route('admin.materi.halaman16.reset') }}" method="POST" class="mt-3">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Ulangi Kuis</button>
            </form>
            <div class="alert alert-warning mt-3">Nilai kamu belum mencapai KKM. Silakan ulangi kuis ini.</div>
        @elseif($sudahMenjawab && $status === 'lulus')
            <div class="alert alert-success mt-3">Selamat, kamu telah mencapai KKM. Kamu boleh melanjutkan ke halaman berikutnya.</div>
        @endif
    </div>

    <div class="card-footer d-flex justify-content-between align-items-center">
        <a href="{{ route('admin.materi.halaman15') }}" class="btn btn-secondary">← Sebelumnya</a>
        @if($sudahMenjawab && $status === 'lulus')
            <a href="{{ route('admin.evaluasi.petunjuk') }}" class="btn btn-success">Selanjutnya →</a>
        @else
            <button class="btn btn-primary disabled">Selanjutnya →</button>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    let dragged;
    const alatList = document.querySelectorAll('.alat-satuan');

    alatList.forEach(el => {
        el.addEventListener('dragstart', function (e) {
            dragged = this.cloneNode(true);
            dragged.setAttribute('data-soal', this.getAttribute('data-soal'));
        });
    });

    const dropZones = document.querySelectorAll('.drop-zone');
    dropZones.forEach(zone => {
        const soalId = zone.dataset.soal;
        const inputField = document.getElementById('jawabanDrop' + soalId);
        const maxItems = parseInt(zone.getAttribute('data-max'), 10);

        if (zone.classList.contains('disabled')) return;

        zone.addEventListener('dragover', e => e.preventDefault());
        zone.addEventListener('drop', e => {
            e.preventDefault();
            if (zone.querySelectorAll('img').length >= maxItems) return;
            if (dragged.getAttribute('data-soal') !== soalId) return;

            const clone = dragged.cloneNode(true);
            clone.removeAttribute('id');
            clone.setAttribute('draggable', false);
            zone.appendChild(clone);
            if (inputField) inputField.value = zone.querySelectorAll('img').length;
        });
    });
});
</script>
@endpush
