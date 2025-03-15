<?php

namespace App\Imports;

use App\Models\Buku;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\WithValidation;

class ImportBuku implements ToModel, WithHeadingRow, WithValidation
{
    /**
    * @param Collection $collection
    */

    public function model(array $row)
    {
        return new Buku([
            'judul' => $row['judul_buku'],
            'slug' => Str::slug($row['judul_buku']),
            'penulis' => $row['penulis'],
            'penerbit' => $row['penerbit'],
            'tahun_terbit' => $row['tahun_terbit'],
            'deskripsi' => $row['deskripsi'],
            'kode' => $row['kode_buku'],
            'stok' => $row['stok'],
            'cover' => $row['cover'],
        ]);
    }

    public function rules(): array
    {
        return [
            'judul_buku'  => 'required|string',
            'penulis'     => 'required|string',
            'penerbit'    => 'required|string',
            'tahun_terbit'=> 'required|integer',
            'kode_buku'   => 'required|string',
            'stok'        => 'required|integer',
            'deskripsi'   => 'nullable|string',
            'cover'       => 'nullable|string',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'tahun_terbit.integer' => 'Tahun terbit harus berupa angka.',
            'stok.integer'         => 'Stok harus berupa angka.',
        ];
    }
}
