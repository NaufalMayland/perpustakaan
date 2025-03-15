<?php

namespace App\Exports;

use App\Models\Peminjaman;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PeminjamanExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Peminjaman::with(['buku', 'peminjam', 'petugas'])->whereNot('status', 'dikembalikan')->get();
    }

    public function headings(): array
    {
        return [
            'Peminjam',
            'Buku',
            'Jumlah',
            'Tanggal Pinjam',
            'Tanggal Kembali',
            'Perpanjangan',
            'Status',
        ];
    }

    public function map($peminjaman): array
    {
        return [
            $peminjaman->peminjam->nama ?? '-', 
            $peminjaman->buku->judul ?? '-', 
            $peminjaman->jumlah ?? '-', 
            \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->translatedFormat('j F Y'),
            \Carbon\Carbon::parse($peminjaman->tanggal_kembali)->translatedFormat('j F Y'),
            $peminjaman->perpanjangan ? $peminjaman->perpanjangan." Hari" : "-" ,
            $peminjaman->status ?? '-', 
        ];
    }
}
