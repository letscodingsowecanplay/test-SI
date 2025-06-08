@extends('layouts.master')

@section('content')
    <div class="card bg-coklat fs-5">
        <div class="card-header">
            <div class="float-start">
                Data Siswa
            </div>
            <div class="float-end">
                <a class="btn btn-success btn-sm text-white fs-5" href="{{ route('admin.datasiswa.create') }}">
                    Tambah Siswa
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table border-dark">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>NISN</th>
                            <th>Register At</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($siswa as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->nisn ?? '-' }}</td>
                                <td>{{ $item->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <a href="{{ route('admin.datasiswa.edit', $item->id) }}" class="badge bg-info fs-5">Edit</a>

                                    <form method="POST" action="{{ route('admin.datasiswa.destroy', $item->id) }}"
                                          style="display: inline-block;"
                                          onsubmit="return confirm('Yakin ingin menghapus siswa ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="badge bg-danger border-0 fs-5">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer custom-pagination">
            {{ $siswa->links() }}
        </div>
    </div>
    <br>
@endsection
