@extends('layouts.master')

@section('content')
    <div class="card bg-coklat fs-5">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="float-start">
                Data Hasil Belajar Siswa
            </div>
            <form method="GET" class="d-flex gap-2">
                <select name="kuis_id" class="form-select form-select-sm fs-5">
                    <option value="">-- Semua Hasil Belajar --</option>
                    @foreach($kuisIds as $kuis)
                        <option value="{{ $kuis }}" {{ $kuisDipilih == $kuis ? 'selected' : '' }}>
                            {{ ucfirst(str_replace('-', ' ', $kuis)) }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary btn-sm fs-5">Filter</button>
            </form>
        </div>

        <div class="card-body">
            <div class="mb-3 d-flex gap-2">
                <a href="{{ route('admin.hasilbelajar.export', ['format' => 'excel', 'kuis_id' => request('kuis_id')]) }}" class="btn bg-coklap1 text-white btn-sm fs-5">
                    Export Excel
                </a>
                <a href="{{ route('admin.hasilbelajar.export', ['format' => 'pdf', 'kuis_id' => request('kuis_id')]) }}" class="btn bg-coklap2 text-white btn-sm fs-5">
                    Export PDF
                </a>
            </div>

            <div class="table-responsive">
                <table class="table border-dark">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NISN</th>
                            <th>Nilai</th>
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
                                    <form action="{{ route('admin.hasilbelajar.destroy', $row->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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
            {{ $nilai->links() }}
        </div>
    </div>
    <br>
@endsection
