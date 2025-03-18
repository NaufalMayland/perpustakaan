<?php

namespace App\Exports;

use App\Models\Denda;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class DendaExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $filterBulan;

    public function __construct($filterBulan)
    {
        $this->filterBulan = $filterBulan;
    }

    public function collection()
    {
        $query = Denda::with(['peminjaman.buku', 'peminjaman.peminjam']);

        if ($this->filterBulan && $this->filterBulan !== 'semua') {
            $query->whereMonth('created_at', $this->filterBulan)
                  ->whereYear('created_at', Carbon::now()->year);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'Peminjam',
            'Buku Pinjaman',
            'Tanggal Pinjam',
            'Tanggal Kembali',
            'Tanggal Dikembalikan',
            'Jumlah',
            'Status Denda',
        ];
    }

    public function map($denda): array
    {
        return [
            $denda->peminjaman->peminjam->nama,
            $denda->peminjaman->buku->judul,
            \Carbon\Carbon::parse($denda->peminjaman->tanggal_pinjam)->translatedFormat('j F Y'),
            \Carbon\Carbon::parse($denda->peminjaman->tanggal_kembali)->translatedFormat('j F Y'),
            \Carbon\Carbon::parse($denda->peminjaman->tanggal_dikembalikan)->translatedFormat('j F Y'),
            $denda->peminjaman->jumlah,
            $denda->status,
        ];
    }
}
