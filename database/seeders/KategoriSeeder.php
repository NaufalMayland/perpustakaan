<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
                'slug' => Str::slug('Novel'),
            ],
            [
                'kategori' => 'Sejarah',
                'slug' => Str::slug('Sejarah'),
            ],
            [
                'kategori' => 'Psikologi',
                'slug' => Str::slug('Psikologi'),
            ],
            [
                'kategori' => 'Sains',
                'slug' => Str::slug('Sains'),
            ],
            [
                'kategori' => 'Komik',
                'slug' => Str::slug('Komik'),
            ],
        ];

        Kategori::insert($data);
    }
}
