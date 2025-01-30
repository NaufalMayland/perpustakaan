<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'username' => 'petugas1',
                'email' => 'petugas1@gmail.com',
                'password' => Hash::make('1'),
                'role_id' => 2
            ],
            [
                'username' => 'petugas2',
                'email' => 'petugas2@gmail.com',
                'password' => Hash::make('2'),
                'role_id' => 2
            ]
        ];

        User::insert($data);
    }
}
