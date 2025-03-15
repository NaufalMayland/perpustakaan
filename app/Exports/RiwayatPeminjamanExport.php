<?php

namespace App\Exports;

use App\Models\Peminjaman;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class RiwayatPeminjamanExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Peminjaman::with(['buku', 'peminjam', 'petugas'])->where('status', 'dikembalikan')->get();
    }

    public function headings(): array
    {
        return [
            'Peminjam',
            'Buku',
            'Jumlah',
            'Tanggal Pinjam',
            'Tanggal Kembali',
            'Tanggal Dikembalikan',
            'Perpanjangan',
            'Status',
        ];
    }

    public function map($riwayatPeminjaman): array
    {
        return [
            $riwayatPeminjaman->peminjam->nama ?? '-', 
            $riwayatPeminjaman->buku->judul ?? '-', 
            $riwayatPeminjaman->jumlah ?? '-', 
            \Carbon\Carbon::parse($riwayatPeminjaman->tanggal_pinjam)->translatedFormat('j F Y'),
            \Carbon\Carbon::parse($riwayatPeminjaman->tanggal_kembali)->translatedFormat('j F Y'),
            $riwayatPeminjaman->tanggal_dikembalikan ? \Carbon\Carbon::parse($riwayatPeminjaman->tanggal_dikembalikan)->translatedFormat('j F Y') : "-",
            $riwayatPeminjaman->perpanjangan ? $riwayatPeminjaman->perpanjangan." Hari" : "-" ,
            $riwayatPeminjaman->status ?? '-', 
        ];
    }
}
