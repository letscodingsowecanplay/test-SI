@extends('layouts.master')

@section('content')
    <div class="card bg-coklat">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="float-start">
                Data Latihan Siswa
            </div>
            <form method="GET" class="d-flex gap-2">
                <select name="kuis_id" class="form-select form-select-sm">
                    <option value="">-- Semua Latihan --</option>
                    @foreach($kuisIds as $kuis)
                        <option value="{{ $kuis }}" {{ $kuisDipilih == $kuis ? 'selected' : '' }}>
                            {{ ucfirst(str_replace('-', ' ', $kuis)) }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary btn-sm">Filter</button>
            </form>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table border-dark">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NISN</th>
                            <th>Skor</th>
                            <th>Hari</th>
                            <th>Waktu</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($nilai as $i => $row)
                            <tr>
                                <td>{{ $loop->iteration + ($nilai->firstItem() - 1) }}</td>
                                <td>{{ $row->user->name }}</td>
                                <td>{{ $row->user->nisn ?? '-' }}</td>
                                <td>{{ $row->skor }}</td>
                                <td>{{ \Carbon\Carbon::parse($row->created_at)->format('j/n/Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($row->created_at)->format('H.i.s') }}</td>
                                <td>
                                    <a href="{{ route('admin.datalatihan.edit', $row) }}" class="btn btn-sm btn-info">Edit</a>

                                    <form action="{{ route('admin.datalatihan.destroy', $row->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="badge bg-danger border-0">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer custom-pagination">
            {{ $nilai->links() }}
        </div>
    </div>
@endsection
