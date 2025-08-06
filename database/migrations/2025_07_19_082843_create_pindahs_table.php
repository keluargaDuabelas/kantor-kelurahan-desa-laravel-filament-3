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
        Schema::create('pindahs', function (Blueprint $table) {
            $table->id();


    $table->string('alamat_asal');
    $table->string('alamat_datang');

    $table->string('status')->default('Diproses');  // Bisa default

    $table->date('tanggal_pindah')->nullable();

            $table->foreignId('penduduk_id')->nullable()->constrained('penduduks')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pindahs');
    }
};
