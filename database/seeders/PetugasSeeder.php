<?php

namespace Database\Seeders;

use App\Models\Petugas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PetugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama' => "Somebody's Pleasure",
                'email' => "naufal123@gmail.com",
                'role' => 'admin'
            ],
            [
                'nama' => "Risalah Hati",
                'email' => "maylandri123@gmail.com",
                'role' => 'petugas'
            ],
        ];

        Petugas::insert($data);
    }
}
