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
                        <td class="text-sm text-center font-bold p-2">NO</td>
                        <td class="text-sm text-center font-bold p-2">PEMINJAM</td>
                        <td class="text-sm text-center font-bold p-2">BUKU PINJAMAN</td>
                        <td class="text-sm text-center font-bold p-2">TANGGAL PINJAM</td>
                        <td class="text-sm text-center font-bold p-2">TANGGAL KEMBALI</td>
                        <td class="text-sm text-center font-bold p-2">TANGGAL DIKEMBALIKAN</td>
                        <td class="text-sm text-center font-bold p-2">JUMLAH</td>
                        <td class="text-sm text-center font-bold p-2">STATUS DENDA</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($denda as $item)
                        <tr>
                            <td class="text-sm p-2">{{ $i++ }}</td>
                            <td class="text-sm p-2">{{ $item->peminjaman->peminjam->nama }}</td>
                            <td class="text-sm p-2">{{ $item->peminjaman->buku->judul }}</td>
                            <td class="text-sm p-2">{{ \Carbon\Carbon::parse($item->peminjaman->tanggal_pinjam)->translatedFormat('j F Y') }}</td>
                            <td class="text-sm p-2">{{ \Carbon\Carbon::parse($item->peminjaman->tanggal_kembali)->translatedFormat('j F Y') }}</td>
                            <td class="text-sm p-2">{{ \Carbon\Carbon::parse($item->peminjaman->tanggal_dikembalikan)->translatedFormat('j F Y') }}</td>
                            <td class="text-sm p-2">{{ $item->peminjaman->jumlah }}</td>
                            <td class="text-sm p-2">{{ $item->status }}</td>
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