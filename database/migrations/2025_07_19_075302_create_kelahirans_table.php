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
        Schema::create('kelahirans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_bayi');

            $table->string('nama_ibu');
            $table->date('tanggal_lahir_bayi');
            $table->time('jam_lahir_bayi');
            $table->string('tempat_lahir_bayi');
            $table->string('jenis_kelamin_bayi');
            $table->string('berat_bayi');
            $table->string('panjang_bayi');
            $table->string('alamat');
           $table->foreignId('penduduk_id')->nullable()->constrained('penduduks')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelahirans');
    }
};
