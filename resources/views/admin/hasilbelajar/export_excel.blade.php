<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NISN</th>
            <th>Skor</th>
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
