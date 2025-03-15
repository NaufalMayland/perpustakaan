<?php

namespace App\Imports;

use App\Models\Kategori;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ImportKategori implements ToModel, WithHeadingRow, WithValidation
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        return new Kategori([
            'kategori' => $row['kategori'],
            'slug' => Str::slug($row['kategori']),
        ]);
    }

    public function rules(): array
    {
        return [
            'kategori'  => 'required|string',
        ];
    }
}
