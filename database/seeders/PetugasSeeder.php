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
                'nama' => "Superadmin",
                'email' => "sadmin123@gmail.com",
                'role' => 'admin'
            ],
            [
                'nama' => "Petugas",
                'email' => "petugas123@gmail.com",
                'role' => 'petugas'
            ],
        ];

        Petugas::insert($data);
    }
}
