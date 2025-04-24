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
        Schema::create('decrees', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_sk');
            $table->enum('jenis_sk', ['SK Yayasan', 'SK Rektorat']);
            $table->string('tentang');
            $table->text('deskripsi')->nullable();
            $table->string('file_sk')->nullable();
            $table->date('tanggal_terbit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('decrees');
    }
}; 