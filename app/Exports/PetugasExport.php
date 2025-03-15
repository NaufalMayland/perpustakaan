<?php

namespace App\Exports;

use App\Models\Petugas;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PetugasExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Petugas::select('nama', 'email', 'alamat', 'telepon', 'role')->get();
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Email',
            'Alamat',
            'Telepon',
            'Hak Akses',
        ];
    }

    public function map($petugas): array
    {
        $alamat = $petugas->alamat ? json_decode($petugas->alamat, true) : null;

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
            $petugas->nama,
            $petugas->email,
            $formattedAlamat,
            $petugas->telepon ?? "-",
            $petugas->role,
        ];
    }
}
