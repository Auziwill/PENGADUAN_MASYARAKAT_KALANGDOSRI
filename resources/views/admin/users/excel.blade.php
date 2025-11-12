<table>
    <thead>
    <tr>
        <th>No</th>
        <th>Pelapor</th>
        <th>Judul Pengaduan</th>
        <th>Isi Ringkasan</th>
        <th>Lokasi</th>
        <th>Foto</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>

    @foreach($pengaduan as $p)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $p->user->nama ?? '-' }}</td>
            <td>{{ $p->judul }}</td>
            <td>{{ $p->isi}}</td>
            <td>{{ $p->lokasi }}</td>
            <td>{{ $p->foto }}</td>
            <td>{{ $p->status }}</td>
        </tr>
    @endforeach
    </tbody>
</table>