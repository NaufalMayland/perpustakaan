<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'kategori' => 'Novel',
            ],
            [
                'kategori' => 'Sejarah',
            ],
            [
                'kategori' => 'Psikologi',
            ],
            [
                'kategori' => 'Sains',
            ],
            [
                'kategori' => 'Komik',
            ],
        ];

        Kategori::insert($data);
    }
}
