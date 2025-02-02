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
                        <td class="text-sm text-center font-bold p-2">JUDUL</td>
                        <td class="text-sm text-center font-bold p-2">PENULIS</td>
                        <td class="text-sm text-center font-bold p-2">PENERBIT</td>
                        <td class="text-sm text-center font-bold p-2">TAHUN TERBIT</td>
                        <td class="text-sm text-center font-bold p-2">DESKRIPSI</td>
                        <td class="text-sm text-center font-bold p-2">KODE</td>
                        <td class="text-sm text-center font-bold p-2">STOK</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($buku as $item)
                        <tr>
                            <td class="text-sm p-2 text-center">{{$i++}}</td>
                            <td class="text-sm p-2">{{$item->judul}}</td>
                            <td class="text-sm p-2">{{$item->penulis}}</td>
                            <td class="text-sm p-2">{{$item->penerbit}}</td>
                            <td class="text-sm p-2">{{$item->tahun_terbit}}</td>
                            <td class="text-sm p-2">{{$item->deskripsi}}</td>
                            <td class="text-sm p-2">{{$item->kode}}</td>
                            <td class="text-sm p-2">{{$item->stok}}</td>
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