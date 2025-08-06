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
        Schema::create('datangs', function (Blueprint $table) {
            $table->id();

              $table->date('tanggal_pindah')->nullable();
             $table->string('alasan_datang');
               $table->string('desa_asal');
                 $table->string('kecamatan_asal');
                   $table->string('kabupaten_asal');
                     $table->string('provinsi_asal');

                     $table->foreignId('keluarga_id')->nullable()->constrained('keluargas')->onDelete('cascade');
                     $table->foreignId('penduduk_id')->nullable()->constrained('penduduks')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datangs');
    }
};
