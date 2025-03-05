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
        Schema::create('tabel_album', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('id_kecamatan');
            $table->integer('id_album_kategori');
            $table->string('nama_foto', 100);
            $table->text('file');
            $table->timestamp('added')->useCurrent();
            $table->timestamp('edited')->useCurrent()->useCurrentOnUpdate();
            $table->integer('add_by')->nullable();

            $table->foreign('id_kecamatan')->references('id_kecamatan')->on('tabel_kecamatan')->onDelete('cascade');
            $table->foreign('id_album_kategori')->references('id_album_kategori')->on('tabel_album_kategori')->onDelete('cascade');
            $table->foreign('add_by')->references('id_user')->on('user_login')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabel_album');
    }
};
