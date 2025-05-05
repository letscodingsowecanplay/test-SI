@extends('layouts.master-evaluasi')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between">
        <!-- Kiri: Soal -->
        <div class="card w-75 me-3">
            <div class="card-body">
                <h5><strong>KUIS 1</strong></h5>
                <p><strong>Soal No. {{ $nomor }}</strong></p>
                <p>{{ $soal->pertanyaan }}</p>

                <form method="POST" action="{{ route('evaluasi.simpan_jawaban') }}">
                    @csrf
                    <input type="hidden" name="soal_id" value="{{ $soal->id }}">
                    @foreach ($soal->opsi as $key => $opsi)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jawaban" id="opsi{{ $key }}" value="{{ $key }}"
                                {{ $jawaban_terpilih == $key ? 'checked' : '' }}>
                            <label class="form-check-label" for="opsi{{ $key }}">
                                {{ $opsi }}
                            </label>
                        </div>
                    @endforeach

                    <div class="d-flex justify-content-between mt-4">
                        @if ($nomor > 1)
                            <a href="{{ route('evaluasi.soal', $nomor - 1) }}" class="btn btn-outline-success">
                                &laquo; Sebelumnya
                            </a>
                        @else
                            <div></div>
                        @endif
                        <button type="submit" class="btn btn-success">
                            Berikutnya &raquo;
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Kanan: Navigasi & Info -->
        <div class="card w-25">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <strong>Nomor Soal</strong>
                    <span class="text-danger"><i class="bi bi-clock"></i> {{ $sisa_waktu }}</span>
                </div>

                <div class="d-flex flex-wrap mb-3">
                    @foreach ($semua_soal as $i => $s)
                        @php
                            $answered = in_array($s->id, $soal_dijawab);
                        @endphp
                        <a href="{{ route('evaluasi.soal', $i + 1) }}"
                           class="btn btn-sm m-1 {{ $answered ? 'bg-success text-white' : 'border border-success' }}">
                            {{ $i + 1 }}
                        </a>
                    @endforeach
                </div>

                <p><strong>Keterangan:</strong></p>
                <div class="d-flex align-items-center mb-1">
                    <div class="border border-success me-2" style="width: 20px; height: 20px;"></div>
                    <span>Belum dijawab</span>
                </div>
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-success me-2" style="width: 20px; height: 20px;"></div>
                    <span class="text-white">Sudah dijawab</span>
                </div>

                <a href="{{ route('evaluasi.selesai') }}" class="btn btn-danger w-100">Selesai</a>
            </div>
        </div>
    </div>
</div>
@endsection
