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
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_peminjam');
            $table->unsignedBigInteger('id_buku');
            $table->unsignedBigInteger('id_petugas');
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali');
            $table->date('tanggal_dikembalikan')->nullable();
            $table->enum('status', ['proses', 'dipinjam', 'dikembalikan'])->default('proses');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('peminjamans', function (Blueprint $table) {
            $table->foreign('id_peminjam')->references('id')->on('peminjams');
            $table->foreign('id_buku')->references('id')->on('bukus');
            $table->foreign('id_petugas')->references('id')->on('petugas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamans');
    }
};
