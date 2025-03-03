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
        Schema::create('tabel_grup_atribut', function (Blueprint $table) {
            $table->id('id_grup_atribut');
            $table->unsignedBigInteger('id_layer')->nullable();
            $table->string('judul_grup_atribut', 255)->nullable();
            $table->text('sub_judul_grup_atribut')->nullable();
            $table->string('tipe_grup_atribut', 255)->nullable();
            $table->string('ukuran_grup_atribut', 255)->nullable();
            $table->longText('pos_grup_atribut_item')->nullable();
            $table->unsignedBigInteger('id_user')->nullable();
            $table->timestamps();

            $table->foreign('id_layer')->references('id_layer')->on('tabel_layer')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabel_grup_atribut');
    }
};
