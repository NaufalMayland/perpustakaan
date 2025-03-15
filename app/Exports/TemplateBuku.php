<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class TemplateBuku implements WithHeadings   
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array
    {
        return [
            'Judul Buku',
            'Penulis',
            'Penerbit',
            'Tahun Terbit',
            'Deskripsi',
            'Kode Buku',
            'Stok',
            'Cover',
        ];
    }
}
