<!DOCTYPE html>
<html>
<head>
    <title>Data Peminjam</title>
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
    <h2>Daftar Peminjam</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Alamat</th>
                <th>Telepon</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach($dataPeminjam as $item)
            @php
                $alamat = json_decode($item->alamat, true);
            @endphp
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->email }}</td>
                <td>
                    @if ($item->alamat == null)
                        -
                    @else
                        {{ $alamat['kelurahan']['name'] }}, {{ $alamat['kecamatan']['name'] }}, {{ $alamat['kabupaten']['name'] }}, {{ $alamat['provinsi']['name'] }}
                    @endif
                </td>
                <td>{{ $item->telepon ?? "-" }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
