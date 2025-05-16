@extends('layouts.master')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
@endsection

@section('content')
    <div class="card bg-coklat">
        <div class="card-header">
            Edit User
        </div>
        <form action="{{ route("admin.users.update", [$user->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="mb-3">
                    <label for="name">Name*</label>
                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name', $user->name) }}" required>
                    @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email">Email*</label>
                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="roles">Roles*
                        <span class="btn btn-info btn-sm select-all">Select All</span>
                        <span class="btn btn-info btn-sm deselect-all">Deselect all</span>
                    </label>
                    <select name="roles[]" id="roles"
                            class="form-control select2 @error('roles') is-invalid @enderror" multiple="multiple"
                            required>
                        @foreach($roles as $id => $role)
                            <option value="{{ $id }}"
                                {{ (in_array($id, old('roles', $user->roles->pluck('id')->toArray()))) ? 'selected' : '' }}>
                                {{ $role }}
                            </option>
                        @endforeach
                    </select>
                    @error('roles')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary me-2" type="submit">Update</button>
                <a class="btn btn-secondary" href="{{ route('admin.users.index') }}">Back to list</a>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
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

            $(".select2").select2({ tags: true });
        });
    </script>
@endsection
