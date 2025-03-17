<!DOCTYPE html>
<html>
<head>
    <title>Data Denda</title>
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
    <h2>Daftar Denda</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Peminjam</th>
                <th>Buku Pinjaman</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Tanggal Dikembalikan</th>
                <th>Jumlah</th>
                <th>Status Denda</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach($dataDenda as $item)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $item->peminjaman->peminjam->nama }}</td>
                <td>{{ $item->peminjaman->buku->judul }}</td>
                <td>{{ \Carbon\Carbon::parse($item->peminjaman->tanggal_pinjam)->translatedFormat('j F Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($item->peminjaman->tanggal_kembali)->translatedFormat('j F Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($item->peminjaman->tanggal_dikembalikan)->translatedFormat('j F Y') }}</td>
                <td>{{ $item->peminjaman->jumlah }}</td>
                <td>{{ $item->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
