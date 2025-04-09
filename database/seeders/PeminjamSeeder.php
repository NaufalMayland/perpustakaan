<?php

namespace Database\Seeders;

use App\Models\Peminjam;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PeminjamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => "1234567890123456",
                'nama' => "Peminjam",
                'email' => "peminjam123@gmail.com",
            ]
        ];

        Peminjam::insert($data);
    }
}
