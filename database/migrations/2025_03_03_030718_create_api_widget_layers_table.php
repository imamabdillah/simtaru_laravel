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
        Schema::create('tabel_api_widget_layer', function (Blueprint $table) {
            $table->id('id_api_widget_layer');
            $table->unsignedBigInteger('id_api_widget');
            $table->unsignedBigInteger('id_layer');
            $table->timestamp('created_at')->nullable();

            $table->foreign('id_api_widget')->references('id_api_widget')->on('tabel_api_widget')->onDelete('cascade');
            $table->foreign('id_layer')->references('id_layer')->on('tabel_layer')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabel_api_widget_layer');
    }
};
