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
       Schema::table('kelahirans', function (Blueprint $table) {
            $table->dropForeign(['penduduk_id']);
        });

        // Langkah 2: Hapus kolom
        Schema::table('kelahirans', function (Blueprint $table) {
            $table->dropColumn('penduduk_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kelahirans', function (Blueprint $table) {
            //
        });
    }
};
