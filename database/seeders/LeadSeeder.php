<?php

namespace Database\Seeders;

use App\Models\Lead;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Lead::create([
            'nama'   => 'Budi Santoso',
            'email'  => 'budi@example.com',
            'alamat' => 'Jl. Mawar No. 10, Malang',
            'status' => 'new',
        ]);
    }
}
