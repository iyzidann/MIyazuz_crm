<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $produk = [
            [
                'nama' => 'Kantor 50 Mbps',
                'deskripsi' => 'Paket usaha kecil 50 Mbps dedicated untuk 10-15 perangkat',
                'harga' => 1200000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Enterprise 200 Mbps',
                'deskripsi' => 'Paket korporat 200 Mbps dengan SLA 99.9%, static IP',
                'harga' => 3500000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Unlimited 3 Mbps',
                'deskripsi' => 'Paket unlimited 3 Mbps tanpa FUP, harga terjangkau',
                'harga' => 200000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('produk')->insert($produk);
    }
}
