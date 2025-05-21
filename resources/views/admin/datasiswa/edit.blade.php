@extends('layouts.master')

@section('content')
<div class="card bg-coklat">
    <div class="card-header">Edit Siswa</div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.datasiswa.update', $user->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name">Nama</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="mb-3">
                <label for="nisn">NISN</label>
                <input type="text" name="nisn" class="form-control" value="{{ old('nisn', $user->nisn) }}" required>
            </div>

            <div class="mb-3">
                <label for="password">Password Baru (Kosongkan jika tidak ingin mengubah)</label>
                <input type="password" name="password" class="form-control">
            </div>

            <div class="mb-3">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.datasiswa.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
