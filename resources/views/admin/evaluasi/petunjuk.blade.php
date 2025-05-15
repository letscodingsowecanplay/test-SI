@extends('layouts.app') 

@section('content')
<div class="container py-4">
    <div class="row">

        {{-- Kolom 1: Profil dan Daftar Isi --}}
        <div class="col-md-4 mb-3">
            <div class="card text-center">
                <img src="https://via.placeholder.com/100" alt="Profile" class="rounded-circle mx-auto mt-3" style="width: 100px;">
                <div class="card-body">
                    <h5 class="card-title">{{ $user->name }}</h5>
                    <hr>
                    <h6><strong>Daftar Isi</strong></h6>
                    <p><strong>Bab 1 Ayo Membilang Menghitung dan Menulis Bilangan</strong></p>
                    <ul class="text-start px-3">
                        <li>Menghitung, dan Menulis Bilangan</li>
                        <li>Membandingkan Banyak Bilangan dalam Benda</li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Kolom 2: Petunjuk Kuis --}}
        <div class="col-md-4 mb-3">
            <div class="card">
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
            <div class="card">
                <div class="card-header">
                    <i class="bi bi-gear"></i> Data Siswa
                </div>
                <div class="card-body">
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>Kelas:</strong> 1</p>
                    <p><strong>Nama:</strong> {{ $user->name }}</p>
                    <p><strong>Sekolah:</strong> SD Banjarmasin</p>

                    <div class="d-flex justify-content-around mt-4">
                        <a href="{{ route('admin.materi.index') }}" class="btn btn-danger rounded-pill">Kembali ke Materi</a>

                        @if(!$hasil)
                            <a href="{{ route('admin.evaluasi.index') }}" class="btn btn-primary rounded-pill">Mulai Kuis</a>
                        @else
                            <button class="btn btn-secondary rounded-pill" disabled>Sudah Dikerjakan</button>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Jika sudah ada hasil, tampilkan nilai --}}
            @if($hasil)
                <div class="card mt-4">
                    <div class="card-header text-center"><strong>Hasil Kuis</strong></div>
                    <div class="card-body">
                        <p><strong>Skor:</strong> {{ $hasil->skor }} / {{ $hasil->total_soal }}</p>
                        <p><strong>Persentase:</strong> {{ round(($hasil->skor / $hasil->total_soal) * 100) }}%</p>

                        @if($hasil->skor < 7)
                            <p class="text-danger">Nilai Anda di bawah KKM. Silakan pelajari materi lagi.</p>
                        @else
                            <p class="text-success">Selamat! Anda telah lulus evaluasi ini.</p>
                        @endif
                    </div>
                </div>
            @endif
        </div>

    </div>
</div>
@endsection
