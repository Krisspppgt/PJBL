<?php

namespace CategorySeeder;
use Illuminate\Database\Seeder;

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
    }
}