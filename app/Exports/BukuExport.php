<?php

namespace App\Exports;

use App\Models\Buku;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BukuExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Buku::select('judul', 'penulis', 'penerbit', 'tahun_terbit', 'kode', 'stok')->get();
    }

    public function headings(): array
    {
        return [
            'Judul Buku',
            'Penulis',
            'Penerbit',
            'Tahun Terbit',
            'Kode Buku',
            'Stok',
        ];
    }
}
