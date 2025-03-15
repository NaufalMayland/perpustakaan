<?php

namespace App\Exports;

use App\Models\ListKategori;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ListKategoriExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ListKategori::with(['buku', 'kategori'])->get();
    }

    public function headings(): array
    {
        return [
            'Judul Buku',
            'Kategori',
        ];
    }

    public function map($listKategori): array
    {
        return [
            $listKategori->buku->judul ?? '-', 
            $listKategori->kategori->kategori ?? '-', 
        ];
    }
}
