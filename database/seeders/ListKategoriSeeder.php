<?php

namespace Database\Seeders;

use App\Models\ListKategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ListKategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id_buku' => 1,
                'id_kategori' => 2
            ],
            [
                'id_buku' => 2,
                'id_kategori' => 2
            ],
            [
                'id_buku' => 3,
                'id_kategori' => 2
            ],
            [
                'id_buku' => 4,
                'id_kategori' => 2
            ],
            [
                'id_buku' => 5,
                'id_kategori' => 2
            ],
        ];
        ListKategori::insert($data);
    }
}
