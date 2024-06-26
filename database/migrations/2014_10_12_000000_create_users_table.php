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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nis', 10)->nullable();
            $table->string('name', 30);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->text('alamat')->nullable();
            $table->string('telepon', 12)->nullable();
            $table->string('ajaran_kode')->index();
            $table->string('tingkat_kode')->index();
            $table->string('kelas_kode')->index();
            $table->enum('level',['petugas','user','admin'])->default('user');
            $table->string('foto_profile',100)->nullable();
            $table->string('password',100);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
