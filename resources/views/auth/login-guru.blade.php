@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-coklat fs-5">
                <div class="card-header text-center">
                    <b>{{ __('Masuk Sebagai Guru') }}</b>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3 row">
                            <label for="identity" class="col-md-4 col-form-label text-md-end">NIP</label>
                            <div class="col-md-6">
                                <input
                                    id="identity"
                                    type="text"
                                    class="form-control @error('identity') is-invalid @enderror"
                                    name="identity"
                                    value="{{ old('identity') }}"
                                    required
                                    autocomplete="identity"
                                    autofocus
                                >
                                @error('identity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Kata Sandi</label>
                            <div class="col-md-6">
                                <input
                                    id="password"
                                    type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    name="password"
                                    required
                                    autocomplete="current-password"
                                >
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-0 row">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn bg-coklap btn-masuk fs-5">
                                    Masuk
                                </button>
                            </div>
                        </div>

                        @if ($errors->has('identity') || $errors->has('password'))
                            <div class="alert alert-danger mt-3">
                                @foreach ($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            </div>
                        @endif

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
