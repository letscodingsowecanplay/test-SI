@extends('layouts.app') 

@section('content')
<div class="container py-4">
    <div class="row">

        {{-- Kolom 1: Profil dan Daftar Isi --}}
        <div class="col-md-4 mb-3 ">
            <div class="card text-center bg-coklat">
                <div class="card-body">
                    <h6><strong>Kuis 1</strong></h6>
                    <p><strong>Subbab Membandingkan dan Mengurutkan Panjang Benda</strong></p>
                    <ul class="text-start px-3">
                        <li>Membandingkan panjang dua benda</li>
                        <li>Mengurutkan benda berdasarkan panjangnya</li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Kolom 2: Petunjuk Kuis --}}
        <div class="col-md-4 mb-3">
            <div class="card bg-coklat">
                <div class="card-header">
                    <i class="bi bi-info-circle"></i> Petunjuk Kuis
                </div>
                <div class="card-body">
                    <ol class="ps-3">
                        <li>Kuis ini terdiri dari 10 soal.</li>
                        <li>Setiap soal memiliki 10 poin.</li>
                        <li>Tekan "Mulai Kuis" jika data diri anda sudah benar.</li>
                        <li>Bacalah soal dengan teliti dan pilih salah satu jawaban yang kamu anggap benar.</li>
                        <li>Setelah seluruh soal selesai dijawab, klik "Selesai" untuk menyelesaikan kuis.</li>
                        <li>Selamat Mengerjakan, Goodluck!</li>
                    </ol>
                </div>
            </div>

            @if(session('error'))
                <div class="alert alert-warning mt-3">
                    {{ session('error') }}
                </div>
            @endif
        </div>

        {{-- Kolom 3: Data Siswa dan Tombol --}}
        <div class="col-md-4 mb-3">
            <div class="card bg-coklat">
                <div class="card-header">
                    <i class="bi bi-gear"></i> Data Siswa
                </div>
                <div class="card-body">
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>Kelas:</strong> 1</p>
                    <p><strong>Nama:</strong> {{ $user->name }}</p>
                    <p><strong>Sekolah:</strong> SD Banjarmasin</p>

                    <div class="d-flex justify-content-around mt-4">
                            <a href="{{ route('admin.materi.halaman4') }}" class="btn bg-coklapbet rounded-pill d-flex align-items-center justify-content-center text-white">ke Materi Sebelumnya</a>
                        @if(!$hasil)
                            <a href="{{ route('admin.evaluasi.index') }}" class="btn btn-primary rounded-pill">Mulai Kuis</a>
                            <button class="btn btn-secondary rounded-pill" disabled>ke Materi Selanjutnya</button>
                        @else
                            <button class="btn btn-secondary rounded-pill" disabled>Sudah Dikerjakan</button>
                            <a href="{{ route('admin.materi.halaman5') }}" class="btn btn-danger rounded-pill">Lanjut ke Materi Selanjutnya</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($hasil)
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card mt-4 bg-coklat">
                <div class="card-header text-center"><strong>Hasil Kuis</strong></div>
                <div class="card-body">
                    <p><strong>Skor:</strong> {{ $hasil->skor }} / {{ $hasil->total_soal }}</p>
                    <p><strong>Persentase:</strong> {{ round(($hasil->skor / $hasil->total_soal) * 100) }}%</p>

                    @if($hasil->skor < 7)
                        <p class="text-danger">Nilai Anda di bawah KKM. Silakan pelajari materi lagi.</p>
                    @else
                        <p class="text-success">Selamat! Anda telah lulus kuis ini.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
