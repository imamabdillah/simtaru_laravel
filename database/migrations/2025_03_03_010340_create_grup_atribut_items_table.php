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
        Schema::create('tabel_grup_atribut_item', function (Blueprint $table) {
            $table->id('id_grup_atribut_item');
            $table->unsignedBigInteger('id_grup_atribut')->nullable();
            $table->unsignedBigInteger('id_atribut')->nullable();
            $table->string('nama_atribut_layer', 255)->nullable();
            $table->string('alias_atribut_layer', 255)->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->foreign('id_grup_atribut')->references('id_grup_atribut')->on('tabel_grup_atribut')->onDelete('set null');
            $table->foreign('id_atribut')->references('id_atribut')->on('tabel_atribut_layer')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabel_grup_atribut_item');
    }
};
