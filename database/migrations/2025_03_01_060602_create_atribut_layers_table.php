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
        Schema::create('tabel_atribut_layer', function (Blueprint $table) {
            $table->integer('id_atribut')->autoIncrement();
            $table->integer('id_layer');
            $table->string('nama_atribut', 255);
            $table->string('slug', 300);
            $table->enum('tipe_data', ['Text', 'Angka'])->default('Text');
            $table->timestamp('added')->useCurrent();
            $table->timestamp('edited')->useCurrent();
            $table->integer('add_by')->nullable();
            $table->timestamp('is_delete')->nullable();

            $table->foreign('id_layer')->references('id_layer')->on('tabel_layer')->onDelete('cascade');
            $table->foreign('add_by')->references('id_user')->on('user_login')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabel_atribut_layer');
    }
};
