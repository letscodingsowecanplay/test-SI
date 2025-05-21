@extends('layouts.master')

@section('content')
<div class="card bg-coklat">
    <div class="card-header">Edit Data Latihan</div>
    <div class="card-body">
        <form method="POST" action="{{ route("admin.datalatihan.update", $nilai->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Nama Siswa</label>
                <input type="text" class="form-control" value="{{ $nilai->user->name }}" disabled>
            </div>

            <div class="mb-3">
                <label>Kuis ID</label>
                <input type="text" name="kuis_id" class="form-control" value="{{ $nilai->kuis_id }}" required>
            </div>

            <div class="mb-3">
                <label>Skor</label>
                <input type="number" name="skor" class="form-control" value="{{ $nilai->skor }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.datalatihan.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
