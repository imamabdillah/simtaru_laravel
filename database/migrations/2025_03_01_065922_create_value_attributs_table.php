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
        Schema::create('tabel_value_attribut', function (Blueprint $table) {
            $table->integer('id_data')->autoIncrement();
            $table->integer('id_atribut');
            $table->integer('id_collection');
            $table->text('data_value')->nullable();
            $table->timestamp('created')->useCurrent();
            $table->timestamp('edited')->useCurrent()->useCurrentOnUpdate();
            $table->integer('add_by');

            $table->foreign('id_atribut')->references('id_atribut')->on('tabel_atribut_layer')->onDelete('cascade');
            $table->foreign('id_collection')->references('id_collection')->on('tabel_collection')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabel_value_attribut');
    }
};
