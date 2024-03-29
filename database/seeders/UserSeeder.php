<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $data = [
            [
                'email' => 'admin@example.com',
                'name' => 'Admin',
                'password' => Hash::make('123123'),
                'role' => 'admin'
            ],
            [
                'email' => 'admin.1@example.com',
                'name' => 'Admin 1',
                'password' => Hash::make('123123'),
                'role' => 'admin'
            ],
            [
                'email' => 'user@example.com',
                'name' => 'User',
                'password' => Hash::make('123456'),
                'role' => 'user'
            ],
            [
                'email' => 'user.1@example.com',
                'name' => 'User 1',
                'password' => Hash::make('123456'),
                'role' => 'user'
            ],
        ];

        foreach ($data as $key => $val) {
            User::create($val);
        }
    }
}
