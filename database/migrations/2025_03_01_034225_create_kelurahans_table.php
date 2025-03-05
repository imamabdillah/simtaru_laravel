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
        Schema::create('tabel_kelurahan', function (Blueprint $table) {
            $table->integer('id_kelurahan')->autoIncrement();
            $table->string('nama', 255)->nullable();
            $table->integer('id_kecamatan')->nullable();
            $table->foreign('id_kecamatan')->references('id_kecamatan')->on('tabel_kecamatan')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabel_kelurahan');
    }
};
