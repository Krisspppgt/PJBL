<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kategori', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->unique();
            $table->timestamps();
        });

        Schema::table('kategori', function (Blueprint $table) {
            // Insert kategori data
        });

        \DB::table('kategori')->insert([
            ['nama' => 'Cafe', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Restaurant', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Street Food', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Bakery', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Drink Area', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Catering', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori');
    }
};
