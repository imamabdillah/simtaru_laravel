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
        Schema::create('tabel_grup_layer', function (Blueprint $table) {
            $table->bigInteger('id_grup_layer')->autoIncrement();
            $table->string('nama_grup_layer', 255)->nullable();
            $table->integer('id_opd')->nullable();
            $table->foreign('id_opd')->references('id_opd')->on('tabel_referensi_opd')->onDelete('set null');
            $table->integer('id_user')->nullable();
            $table->foreign('id_user')->references('id_user')->on('user_login');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabel_grup_layer');
    }
};
