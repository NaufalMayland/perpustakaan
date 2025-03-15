<?php

namespace App\Exports;

use App\Models\Peminjam;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PeminjamExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Peminjam::select('nama', 'email', 'alamat', 'telepon')->get();
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Email',
            'Alamat',
            'Telepon',
        ];
    }

    public function map($peminjam): array
    {
        $alamat = $peminjam->alamat ? json_decode($peminjam->alamat, true) : null;

        $formattedAlamat = '-';
        if ($alamat) {
            $formattedAlamat = sprintf(
                '%s, %s, %s, %s',
                $alamat['kelurahan']['name'] ?? '-',
                $alamat['kecamatan']['name'] ?? '-',
                $alamat['kabupaten']['name'] ?? '-',
                $alamat['provinsi']['name'] ?? '-'
            );
        }

        return [
            $peminjam->nama,
            $peminjam->email,
            $formattedAlamat,
            $peminjam->telepon ?? "-",
        ];
    }
}
