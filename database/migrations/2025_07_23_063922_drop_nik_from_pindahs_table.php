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

            $table->dropColumn('alamat_asal');
            $table->dropColumn('alamat_datang');
            $table->dropColumn('status');
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
