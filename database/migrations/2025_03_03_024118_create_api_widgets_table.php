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
        Schema::create('tabel_api_widget', function (Blueprint $table) {
            $table->id('id_api_widget');
            $table->string('nama_app', 255)->nullable();
            $table->string('url_app', 255)->nullable();
            $table->string('access_token', 255)->nullable();
            $table->string('api_token', 255)->nullable();
            $table->unsignedBigInteger('id_opd')->nullable();
            $table->unsignedBigInteger('id_user')->nullable();
            $table->string('nama_pemohon', 255)->nullable();
            $table->string('url_map', 255)->nullable();
            $table->timestamps();

            $table->foreign('id_opd')->references('id_opd')->on('tabel_referensi_opd')->onDelete('set null');
            $table->foreign('id_user')->references('id_user')->on('user_login')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabel_api_widget');
    }
};
