@extends('layouts.master')

@section('content')
<div class="card bg-coklat fs-5">
    <div class="card-header">Edit Data Hasil Belajar</div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.hasilbelajar.update', $nilai->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Nama Siswa</label>
                <input type="text" class="form-control" value="{{ $nilai->user->name }}" disabled>
            </div>

            <div class="mb-3">
                <label>Kuis ID</label>
                <input type="text" class="form-control" value="{{ $nilai->kuis_id }}" disabled>
            </div>

            <div class="mb-3">
                <label>Skor</label>
                <input type="number" name="skor" class="form-control" value="{{ $nilai->skor }}" required min="0">
            </div>

            <button type="submit" class="btn btn-primary fs-5">Update</button>
            <a href="{{ route('admin.hasilbelajar.index') }}" class="btn btn-secondary fs-5">Kembali</a>
        </form>
    </div>
</div>
@endsection
