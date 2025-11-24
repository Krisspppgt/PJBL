<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $kategori = [
           ['nama' => 'Cafe'],
           ['nama' => 'Restaurant'],
           ['nama' => 'Street Food'],
           ['nama' => 'Bakery'],
           ['nama' => 'Drink Area'],
           ['nama' => 'Catering'],
       ];

       DB::table('kategori')->insert($kategori);
    }
}
