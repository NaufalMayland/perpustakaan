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
                'nama' => "petugas1",
                'email' => "petugas1@gmail.com",
                'uid' => 'petugas1',
                'role' => 'admin'
            ],
            [
                'nama' => "petugas2",
                'email' => "petugas2@gmail.com",
                'uid' => 'petugas2',
                'role' => 'petugas'
            ]
        ];

        Petugas::insert($data);
    }
}
