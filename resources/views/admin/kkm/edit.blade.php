@extends('layouts.master')

@section('content')
<div class="card bg-coklat fs-5">
    <div class="card-header">Edit KKM: {{ $kkm->kuis_id }}</div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.kkm.update', $kkm) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label>KKM</label>
                <input type="number" name="kkm" class="form-control" value="{{ $kkm->kkm }}" required>
            </div>
            <button type="submit" class="btn btn-primary fs-5">Update</button>
            <a href="{{ route('admin.kkm.index') }}" class="btn btn-secondary fs-5">Kembali</a>
        </form>
    </div>
</div>
@endsection
