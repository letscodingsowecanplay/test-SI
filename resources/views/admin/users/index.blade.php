@extends('layouts.master')

@section('content')
    <div class="card bg-coklat">
        <div class="card-header">
            <div class="float-start">
                User List
            </div>
            @can('permission_create')
                <div class="float-end">
                    <a class="btn btn-success btn-sm text-white" href="{{ route("admin.users.create") }}">
                        Add User
                    </a>
                </div>
            @endcan
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table border-dark">
                    <thead>
                    <tr>
                        <th>
                            ID
                        </th>
                        <th>
                            Name
                        </th>
                        <th>
                            Email
                        </th>
                        <th>
                            Roles
                        </th>
                        <th>
                            Status
                        </th>
                        <th>
                            Register At
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $key => $user)
                        <tr data-entry-id="{{ $user->id }}">
                            <td>
                                {{ $user->id ?? '' }}
                            </td>
                            <td>
                                {{ $user->name ?? '' }}
                            </td>
                            <td>
                                {{ $user->email ?? '' }}
                            </td>
                            <td>
                                @foreach($user->getRoleNames() as $key => $item)
                                    <span class="badge bg-info">{{ $item }}</span>
                                @endforeach
                            </td>
                            <td>
                                @if($user->status)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Blocked</span>
                                @endif
                            </td>
                            <td>
                                {{ $user->created_at->format('Y-m-d') ?? '' }}
                            </td>
                            <td>
                                @if (auth()->user()->hasRole('Guru'))
                                    @if($user->status)
                                        <a href="{{ route('admin.user.banUnban', ['id' => $user->id, 'status' => 0]) }}" class="badge bg-warning">Block</a>
                                    @else
                                        <a href="{{ route('admin.user.banUnban', ['id' => $user->id, 'status' => 1]) }}" class="badge bg-dark">Unblock</a>
                                    @endif

                                    <a class="badge bg-purple" href="{{ route('admin.users.edit', $user->id) }}">
                                        Edit
                                    </a>
                                    

                                    <a href="javascript:void(0)" class="badge bg-danger" onclick="
                                        if(confirm('Are you sure, You want to Delete this ??')) {
                                            event.preventDefault();
                                            document.getElementById('delete-user-form-{{ $user->id }}').submit();
                                        }">Delete</a>

                                    <form id="delete-user-form-{{ $user->id }}" method="post"
                                        action="{{ route('admin.users.destroy', $user->id) }}" style="display: none">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                    </form>
                                @endif
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer clearfix">
            {{ $users->links() }}
        </div>
    </div>
@endsection
