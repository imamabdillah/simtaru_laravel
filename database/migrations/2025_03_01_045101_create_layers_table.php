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
        Schema::create('tabel_layer', function (Blueprint $table) {
            $table->id('id_layer');
            $table->unsignedBigInteger('id_grup_layer')->nullable();
            $table->unsignedBigInteger('id_jenis_peta')->nullable();
            $table->string('nama_layer');
            $table->text('deskripsi_layer')->nullable();
            $table->unsignedBigInteger('id_opd');
            $table->enum('sumber', ['1', '2', '3'])->default('1')->comment('1: database, 2: api, 3: file json');
            $table->text('link_api')->nullable();
            $table->enum('status', ['1', '2'])->default('1')->comment('1: tampil, 2: sembunyi');
            $table->longText('pos_grup_atribut')->nullable();
            $table->timestamp('ditambahkan')->useCurrent();
            $table->timestamp('diupdate')->useCurrent()->useCurrentOnUpdate();
            $table->unsignedBigInteger('ditambah_oleh');
            $table->unsignedBigInteger('diubah_oleh');
            $table->timestamp('is_delete')->nullable();
            $table->unsignedBigInteger('dihapus_oleh')->nullable();
            $table->integer('order_by')->nullable();
            $table->enum('is_perbaikan', ['0', '1'])->default('0');

            // Foreign Keys
            $table->foreign('id_grup_layer')->references('id_grup_layer')->on('tabel_grup_layer')->onDelete('set null');
            $table->foreign('id_jenis_peta')->references('id_jenis_peta')->on('tabel_jenis_peta')->onDelete('set null');
            $table->foreign('id_opd')->references('id_opd')->on('tabel_referensi_opd')->onDelete('cascade');
            $table->foreign('ditambah_oleh')->references('id_user')->on('user_login')->onDelete('cascade');
            $table->foreign('diubah_oleh')->references('id_user')->on('user_login')->onDelete('cascade');
            $table->foreign('dihapus_oleh')->references('id_user')->on('user_login')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabel_layer');
    }
};
