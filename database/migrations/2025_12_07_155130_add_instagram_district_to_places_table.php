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
        Schema::table('places', function (Blueprint $table) {
            // Tambah field instagram dan district
            $table->string('instagram', 100)->nullable()->after('phone');
            $table->string('district', 100)->nullable()->after('address');
            
            // Hapus field latitude dan longitude jika ada
            if (Schema::hasColumn('places', 'latitude')) {
                $table->dropColumn('latitude');
            }
            if (Schema::hasColumn('places', 'longitude')) {
                $table->dropColumn('longitude');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('places', function (Blueprint $table) {
            // Kembalikan field latitude dan longitude
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            
            // Hapus field instagram dan district
            $table->dropColumn(['instagram', 'district']);
        });
    }
};