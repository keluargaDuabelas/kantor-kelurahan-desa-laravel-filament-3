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
        Schema::create('keluargas', function (Blueprint $table) {
            $table->id();
             $table->string('nomor_kepala_keluarga')->unique();
               $table->string('nik_kepala_keluarga')->unique();
                $table->string('nama_kepala_keluarga');
                $table->string('jenis_kelamin_kepala_keluarga');
                $table->date('tanggal_lahir_kepala_keluarga');
                $table->string('tempat_lahir_kepala_keluarga');
                $table->string('alamat_kepala_keluarga');
                $table->string('rt_kepala_keluarga');
                $table->string('rw_kepala_keluarga');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keluargas');
    }
};
