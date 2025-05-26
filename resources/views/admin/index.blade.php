@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-12 col-sm-6 col-xxl-3 d-flex mb-4">
            <div class="card flex-fill bg-coklat">
                <div class="card-body p-0 d-flex flex-fill">
                    <div class="row g-0 w-100">
                        <div class="col-6">
                            <div class=" p-3 m-1">
                                <h4 class="">Selamat datang, {{ auth()->user()->name }}!</h4>
                                @php
                                    $roles = auth()->user()->getRoleNames()->toArray();
                                @endphp
                                <p class="mb-0">{{ implode(" ", $roles) }}</p>
                            </div>
                        </div>
                        @if(auth()->user()->hasRole('Admin'))
                            <div class="col-6 align-self-end text-end">
                                <img src="{{ asset('images/admin/dashboard-admin.png') }}" alt="Customer Support"
                                    class="img-fluid illustration-img">
                            </div>
                        @else
                            <div class="col-6 align-self-end text-end">
                                <img src="{{ asset('images/admin/dashboard-siswa.png') }}" alt="Customer Support"
                                    class="img-fluid illustration-img">
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xxl-3 d-flex mb-4">
            <div class="card flex-fill bg-coklat">
                <div class="card-body py-4">
                    <div class="d-flex align-items-start">
                        <div class="flex-grow-1">
                            <h4 class="mb-2">Capaian Pembelajaran</h3>
                            <p class="mb-2">
                                Pada akhir Fase A, peserta didik dapat membandingkan panjang dan berat
                                benda secara langsung. Mereka dapat mengukur dan mengestimasi panjang
                                benda menggunakan satuan tidak baku.
                            </p>
                            <div class="mb-0">
                            </div>
                        </div>
                        <div class="d-inline-block ms-3">
                            <div class="stat">
                                <svg style="width: 35px; height: 35px;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="#f57f17" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-book-open align-middle text-primary">
                                    <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                                    <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(auth()->user()->hasRole('Admin'))
        <div class="col-12 col-sm-6 col-xxl-3 d-flex mb-4">
            <div class="card flex-fill bg-coklat">
                <a href="{{ route('admin.datasiswa.index') }}" class="text-decoration-none text-reset">
                    <div class="card-body py-4">
                        <div class="d-flex align-items-start">
                            <div class="flex-grow-1">
                                <h4 class="mb-2">Cek Data Siswa</h3>
                                <p class="mb-2">Klik Disini Untuk Cek Data Siswa!</p>
                                <div class="mb-0">
                                </div>
                            </div>
                            <div class="d-inline-block ms-3">
                                <div class="stat">
                                    <svg style="width: 35px; height: 35px;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
                                        stroke="#f57f17" stroke-width="2" class="feather feather-users align-middle text-primary">
                                    <path stroke-linecap="round" stroke-linejoin="round" 
                                            d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m13-5a4 4 0 11-8 0 4 4 0 018 0zM7 8a4 4 0 100 8 4 4 0 000-8z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        @else
        <div class="col-12 col-sm-6 col-xxl-3 d-flex mb-4">
            <div class="card flex-fill bg-coklat">
                <a href="{{ route('admin.materi.index') }}" class="text-decoration-none text-reset">
                    <div class="card-body py-4">
                        <div class="d-flex align-items-start">
                            <div class="flex-grow-1">
                                <h4 class="mb-2">Mulai Belajar</h3>
                                <p class="mb-2">Klik Disini Untuk Mulai Belajar!</p>
                                <div class="mb-0">
                                </div>
                            </div>
                            <div class="d-inline-block ms-3">
                                <div class="stat">
                                    <svg style="width: 35px; height: 35px;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="#f57f17" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="feather feather-bar-chart-2 align-middle text-primary">
                                        <line x1="18" y1="20" x2="18" y2="10"></line>
                                        <line x1="12" y1="20" x2="12" y2="4"></line>
                                        <line x1="6" y1="20" x2="6" y2="14"></line>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        @endif
        @if(auth()->user()->hasRole('Admin'))
            <div class="col-12 col-sm-6 col-xxl-3 d-flex mb-4">
                <div class="card flex-fill bg-coklat">
                    <a href="{{ route('admin.hasilbelajar.index') }}" class="text-decoration-none text-reset">
                        <div class="card-body py-4">
                            <div class="d-flex align-items-start">
                                <div class="flex-grow-1">
                                    <h4 class="mb-2">Cek Hasil Belajar Siswa </h3>
                                    <p class="mb-2">Klik Disini Untuk Cek Data Hasil Belajar Siswa!</p>
                                    <div class="mb-0">
                                    </div>
                                </div>
                                <div class="d-inline-block ms-3">
                                    <div class="stat">
                                        <svg style="width: 35px; height: 35px;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="#f57f17" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="feather feather-bar-chart-2 align-middle text-primary">
                                        <line x1="18" y1="20" x2="18" y2="10"></line>
                                        <line x1="12" y1="20" x2="12" y2="4"></line>
                                        <line x1="6" y1="20" x2="6" y2="14"></line>
                                    `   </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @else
            <div class="col-12 col-sm-6 col-xxl-3 d-flex mb-4">
                <div class="card flex-fill bg-coklat">
                    <a href="{{ route('admin.evaluasi.petunjuk') }}" class="text-decoration-none text-reset">
                        <div class="card-body py-4">
                            <div class="d-flex align-items-start">
                                <div class="flex-grow-1">
                                    <h4 class="mb-2">Mulai Evaluasi</h3>
                                    <p class="mb-2">Klik Disini Untuk Mulai Evaluasi!</p>
                                    <div class="mb-0">
                                    </div>
                                </div>
                                <div class="d-inline-block ms-3">
                                    <div class="stat">
                                        <svg style="width: 35px; height: 35px;" xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 24 24"
                                            fill="none" stroke="#f57f17" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="feather feather-message-square align-middle text-info">
                                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @endif
    </div>
    
@endsection
