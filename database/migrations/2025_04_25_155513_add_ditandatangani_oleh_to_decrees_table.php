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
        Schema::table('decrees', function (Blueprint $table) {
            $table->string('ditandatangani_oleh')->nullable()->after('tanggal_terbit');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('decrees', function (Blueprint $table) {
            $table->dropColumn('ditandatangani_oleh');
        });
    }
};
