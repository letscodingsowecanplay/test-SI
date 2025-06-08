@extends('layouts.master')

@section('content')
<div class="card bg-coklat fs-5">
    <div class="card-header">Tambah Siswa</div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.datasiswa.store') }}">
            @csrf
            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="nisn">NISN</label>
                <input type="text" id="nisn" name="nisn" class="form-control" value="{{ old('nisn', $user->nisn ?? '') }}" required>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success fs-5">Simpan</button>
            <a href="{{ route('admin.datasiswa.index') }}" class="btn btn-secondary fs-5">Kembali</a>
        </form>
    </div>
</div>
<br>
@endsection
