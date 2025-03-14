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
        Schema::create('ulasans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_buku');
            $table->unsignedBigInteger('id_peminjam');
            $table->text('ulasan');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('ulasans', function (Blueprint $table) {
            $table->foreign('id_buku')->references('id')->on('bukus');
            $table->foreign('id_peminjam')->references('id')->on('peminjams');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ulasans');
    }
};
