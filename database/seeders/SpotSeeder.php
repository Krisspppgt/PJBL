<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpotSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('spots')->insert([
            [
                'nama' => 'Spot 1',
                'kategori_id' => 1,
                'lokasi' => 'Lokasi 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Spot 2',
                'kategori_id' => 2,
                'lokasi' => 'Lokasi 2',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
