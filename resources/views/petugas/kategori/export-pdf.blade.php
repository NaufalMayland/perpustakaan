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
                <th>Kategori</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach($dataKategori as $item)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $item->kategori }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
