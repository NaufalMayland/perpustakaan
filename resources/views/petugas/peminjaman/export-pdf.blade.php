<!DOCTYPE html>
<html>
<head>
    <title>Data Buku</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Daftar Buku</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Peminjam</th>
                <th>Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Perpanjangan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach($dataPeminjaman as $item)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $item->peminjam->nama }}</td>
                <td>{{ $item->buku->judul }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->translatedFormat('j F Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_kembali)->translatedFormat('j F Y') }}</td>
                <td>{{ $item->perpanjangan ? $item->perpanjangan." Hari" : "-"}}</td>
                <td class="capitalize">{{ $item->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
