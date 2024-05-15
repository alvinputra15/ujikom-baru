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
            $table->id('id_transaksi');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('petugas_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('petugas_id')->references('id')->on('users');
            $table->tinyInteger('bulan');
            $table->string('kelas');
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
