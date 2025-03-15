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
                'username' => "Somebody's Pleasure",
                'email' => 'naufal123@gmail.com',
                'password' => Hash::make('123456'),
                'role_id' => 2
            ],
            [
                'username' => 'Risalah Hati',
                'email' => 'maylandri123@gmail.com',
                'password' => Hash::make('123456'),
                'role_id' => 2
            ],
        ];

        User::insert($data);
    }
}
