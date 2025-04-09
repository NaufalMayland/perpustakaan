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
                'username' => "Superadmin",
                'email' => 'sadmin123@gmail.com',
                'password' => Hash::make('123456'),
                'role_id' => 2
            ],
            [
                'username' => 'Petugas',
                'email' => 'petugas123@gmail.com',
                'password' => Hash::make('123456'),
                'role_id' => 2
            ],
            [
                'username' => 'Peminjam',
                'email' => 'peminjam123@gmail.com',
                'password' => Hash::make('123456'),
                'role_id' => 1
            ],
        ];

        User::insert($data);
    }
}
