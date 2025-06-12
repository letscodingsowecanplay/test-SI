<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Hasil Belajar Siswa</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin: 10px 0;}
        th, td { border: 1px solid #333; padding: 4px; text-align: left; }
    </style>
</head>
<body>
    <h3>Data Hasil Belajar Siswa</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NISN</th>
                <th>Nilai</th>
                <th>Hari</th>
                <th>Waktu</th>
            </tr>
        </thead>
        <tbody>
            @foreach($nilai as $i => $row)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $row->user->name }}</td>
                    <td>{{ $row->user->nisn ?? '-' }}</td>
                    <td>{{ $row->skor }}</td>
                    <td>{{ \Carbon\Carbon::parse($row->created_at)->format('j/n/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($row->created_at)->format('H.i.s') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
