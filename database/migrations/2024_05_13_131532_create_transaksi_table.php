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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->string('kode_transaksi')->primary();
            $table->unsignedBigInteger('user_id');
            $table->string('ajaran_kode', 6);
            $table->string('metode_kode');
            $table->unsignedBigInteger('kelas_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('ajaran_kode')->references('kode_ajaran')->on('ajarans');
            $table->foreign('metode_kode')->references('kode_metode')->on('metode');
            $table->foreign('kelas_id')->references('id_kelas')->on('kelas');
            $table->date('tanggal_transaksi');
            $table->tinyInteger('bulan');
            $table->integer('nominal');
            $table->enum('status_pembayaran',['lunas'])->default('lunas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
