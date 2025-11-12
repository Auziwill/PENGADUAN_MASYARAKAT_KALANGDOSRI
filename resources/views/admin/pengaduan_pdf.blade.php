<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pengaduan Masyarakat</title>
    <style>
        body { font-family: 'Arial', sans-serif; font-size: 10pt; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        h1 { text-align: center; margin-bottom: 20px; }
        .status-badge {
            padding: 4px 8px;
            border-radius: 5px;
            font-size: 0.8em;
            font-weight: bold;
            color: white;
        }
        .status-menunggu { background-color: #f59e0b; }
        .status-diproses { background-color: #3182ce; }
        .status-selesai { background-color: #2f855a; }
    </style>
</head>
<body>
    <h1>Laporan Data Pengaduan Masyarakat</h1>
    <p>Tanggal Cetak: {{ \Carbon\Carbon::now()->translatedFormat('d F Y, H:i') }} WIB</p>
    
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Pelapor</th>
                <th>Judul Pengaduan</th>
                <th>Isi Ringkas</th>
                <th>Lokasi</th>
                <th>Status</th>
                <th>Tanggal Pengaduan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pengaduans as $index => $p)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $p->user->nama ?? 'Tidak Diketahui' }}</td>
                <td>{{ $p->judul }}</td>
                <td>{{ Str::limit($p->isi, 50) }}</td>
                <td>{{ $p->lokasi ?? '-' }}</td>
                <td><span class="status-badge status-{{ strtolower($p->status) }}">{{ ucfirst($p->status) }}</span></td>
                <td>{{ $p->tanggal_pengaduan ? $p->tanggal_pengaduan->translatedFormat('d F Y, H:i') : 'N/A' }} WIB</td>
            </tr>
            @empty
            <tr>
                <td colspan="7">Tidak ada data pengaduan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>