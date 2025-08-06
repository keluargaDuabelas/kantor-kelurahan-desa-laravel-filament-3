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
        Schema::table('pindahs', function (Blueprint $table) {
             $table->string('alasan_pindah');
               $table->string('desa_tujuan');
                 $table->string('kecamatan_tujuan');
                   $table->string('kabupaten_tujuan');
                     $table->string('provinsi_tujuan');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pindahs', function (Blueprint $table) {
            //
        });
    }
};
