<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                'nama' => 'Manager',
                'email' => 'Manager@example.com',
                'password' => "12345678",
                'role' => "manager",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Sales',
                'email' => 'Sales@example.com',
                'password' => "12345678",
                'role' => "sales",
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('user')->insert($user);
    }
}
