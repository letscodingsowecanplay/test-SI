@extends('layouts.master')

@section('content')
    <div class="card bg-coklat fs-5">
        <div class="card-header">
            <div class="float-start">
                Data Hasil Belajar Siswa
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table border-dark">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kuid_id</th>
                            <th>KKM</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kkm as $i => $row)
                            <tr>
                                <td>{{ $loop->iteration + ($kkm->firstItem() - 1) }}</td>
                                <td>{{ $row->kuis_id }}</td>
                                <td>{{ $row->kkm }}</td>
                                <td>
                                    <a href="{{ route('admin.kkm.edit', $row->id) }}" class="badge bg-info text-white text-decoration-none fs-5">Edit</a>

                                    <form action="{{ route('admin.kkm.destroy', $row->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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
            {{ $kkm->links() }}
        </div>
    </div>
    <br>
@endsection
