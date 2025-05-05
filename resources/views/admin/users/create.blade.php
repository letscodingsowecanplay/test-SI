@extends('layouts.master')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
@endsection

@section('content')

    <div class="card border-0 shadow-sm bg-coklat">
        <div class="card-header">
            Create User
        </div>
        <form action="{{ route("admin.users.store")}}" method="POST">
            @csrf
            <div class="card-body">
                <div class="mb-2">
                    <label for="title">Name*</label>
                    <input type="text" id="title" name="name" class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name', isset($user) ? $user->name : '') }}" required>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="mb-2">
                    <label for="title">Email*</label>
                    <input type="email" id="email" name="email" class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('email', isset($email) ? $user->email : '') }}" required>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="mb-2">
                    <label for="title">Password*</label>
                    <input type="password" id="paasword" name="password" class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('password', isset($password) ? $user->$password : '') }}" required>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="roles">Roles
                        <span class="btn btn-info btn-sm select-all">Select All</span>
                        <span class="btn btn-info btn-sm deselect-all">Deselect all</span>
                    </label>
                    <select name="roles[]" id="roles"
                            class="form-control select2 @error('roles') is-invalid @enderror" multiple="multiple">
                        <!-- @foreach($roles as $id => $role)
                            <option
                                value="{{ $id }}" {{ in_array($id, old('roles', [])) ? 'selected' : '' }}>
                                {{ $role }}
                            </option>
                        @endforeach -->
                        <!-- @foreach($roles as $id => $role)
                            <option
                                value="{{ $id }}" {{ (in_array($id, old('roles', [])) || isset($name) && $name->role->contains($id)) ? 'selected' : '' }}>{{ $role }}</option>
                        @endforeach -->
                        @foreach($roles as $role)
                            <option
                                value="{{ $role->id }}" {{ (in_array($role->id, old('roles', [])) || isset($user) && $user->roles->contains($role->id)) ? 'selected' : '' }}>{{ $role->name }}</option>
                        @endforeach

                    </select>
                    @error('roles')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

            </div>
            <div class="card-footer">
                <button class="btn btn-primary me-2" type="submit">Save</button>
                <a class="btn btn-secondary" href="{{ route('admin.users.index') }}">
                    Back to list
                </a>
            </div>
        </form>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function () {
        $('.select-all').click(function () {
            let $select2 = $(this).parent().siblings('.select2')
            $select2.find('option').prop('selected', 'selected')
            $select2.trigger('change')
        })
        $('.deselect-all').click(function () {
            let $select2 = $(this).parent().siblings('.select2')
            $select2.find('option').prop('selected', '')
            $select2.trigger('change')
        })

        $(".select2").select2();
    });
</script>
