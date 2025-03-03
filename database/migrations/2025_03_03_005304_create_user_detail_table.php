<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('user_detail', function (Blueprint $table) {
            $table->id('id_user_detail');
            $table->unsignedBigInteger('id_user'); // Pastikan tipe data sesuai
            $table->string('nama');
            $table->string('role');
            $table->integer('id_opd');
            $table->boolean('is_active')->default(1);
            $table->timestamp('ditambahkan')->useCurrent();
            $table->timestamp('diupdate')->useCurrentOnUpdate();
            $table->integer('ditambahkan_oleh')->default(0);
            $table->integer('diupdate_oleh')->default(0);
            $table->boolean('is_delete')->nullable();
            $table->integer('dihapus_oleh')->nullable();
            $table->string('no_ktp');
            $table->string('no_hp');
            $table->string('email')->unique();
            $table->text('alamat');
            $table->string('kecamatan');
            $table->string('desa');

            // Menambahkan foreign key dengan kolom id_user
            $table->foreign('id_user')->references('id_user')->on('user_login')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_detail');
    }
};
