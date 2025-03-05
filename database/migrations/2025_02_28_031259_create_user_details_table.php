<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('user_detail', function (Blueprint $table) {
            $table->integer('id_user_detail')->autoIncrement();
            $table->integer('id_user');
            $table->foreign('id_user')->references('id_user')->on('user_login')->onDelete('cascade');
            $table->string('nama')->nullable();
            $table->enum('role', ['1', '2', '3'])->default('3')->comment('1: admin, 2: opd, 3: pemohon');
            $table->unsignedBigInteger('id_opd')->nullable();
            $table->enum('is_active', ['1', '2', '3'])->default('1')->comment('1: aktif, 2: non-aktif, 3: bermasalah');
            $table->timestamps();
            $table->timestamp('is_delete')->nullable();
            $table->string('no_ktp')->nullable();
            $table->string('no_hp', 15)->nullable();
            $table->string('email', 150)->nullable();
            $table->text('alamat')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('desa')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_detail');
    }
};
