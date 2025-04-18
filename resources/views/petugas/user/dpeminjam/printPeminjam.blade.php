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
                        <td class="text-sm text-center font-bold p-2">USERNAME</td>
                        <td class="text-sm text-center font-bold p-2">EMAIL</td>
                        <td class="text-sm text-center font-bold p-2">ALAMAT</td>
                        <td class="text-sm text-center font-bold p-2">TELEPON</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($peminjam as $item)
                        @php
                            $alamat = json_decode($item->alamat, true);
                        @endphp
                        <tr>
                            <td class="text-sm p-2 text-center">{{ $i++ }}</td>
                            <td class="text-sm p-2">{{ $item->nama }}</td>
                            <td class="text-sm p-2">{{ $item->email }}</td>
                            <td class="text-sm p-2">
                                @if ($item->alamat == null)
                                    -
                                @else
                                    {{ $alamat['kelurahan']['name'] }}, {{ $alamat['kecamatan']['name'] }}, {{ $alamat['kabupaten']['name'] }}, {{ $alamat['provinsi']['name'] }}
                                @endif
                            </td>
                            <td class="text-sm p-2">{{ $item->telepon ? $item->telepon : "-" }}</td>
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