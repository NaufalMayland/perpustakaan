<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Perpustakaan | {{$title}}</title>
    <style>
        thead tr td{
            border: 1px solid black;
            background: gray;
        }
        tbody tr td{
            border: 1px solid black;
        }
    </style>
</head>
<body>
    <div class="grid">
        <div class="text-center justify-center items-center mb-4">
            <h1 class="text-lg font-bold">DATA {{ $title }}</h1>
        </div>
        <div class="w-full">
            <table class="w-full table-auto">
                @php
                    $i = 1;
                @endphp
                <thead>
                    <tr>
                        <td class="text-sm text-center uppercase font-bold p-2">NO</td>
                        <td class="text-sm text-center uppercase font-bold p-2">Peminjam</td>
                        <td class="text-sm text-center uppercase font-bold p-2">Buku</td>
                        <td class="text-sm text-center uppercase font-bold p-2">Tanggal Pinjam</td>
                        <td class="text-sm text-center uppercase font-bold p-2">Tanggal Kembali</td>
                        <td class="text-sm text-center uppercase font-bold p-2">Perpanjangan</td>
                        <td class="text-sm text-center uppercase font-bold p-2">Status</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($peminjaman as $item)
                        <tr>
                            <td class="text-sm p-2 text-center">{{ $i++ }}</td>
                            <td class="text-sm p-2">{{ $item->peminjam->nama }}</td>
                            <td class="text-sm p-2">{{ $item->buku->judul }}</td>
                            <td class="text-sm p-2">{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->translatedFormat('j F Y') }}</td>
                            <td class="text-sm p-2">{{ \Carbon\Carbon::parse($item->tanggal_kembali)->translatedFormat('j F Y') }}</td>
                            <td class="text-sm p-2">{{ $item->perpanjangan ? $item->perpanjangan : '-' }}</td>
                            <td class="text-sm p-2 capitalize">{{ $item->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
<script>
    window.print();
</script>
</html>