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
        Schema::create('tabel_api', function (Blueprint $table) {
            $table->integer('id_api')->autoIncrement();
            $table->string('nama_pemohon', 255)->nullable();
            $table->text('token');
            $table->text('akses_layer');
            $table->integer('id_user')->nullable();
            $table->integer('id_opd')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->enum('aktif', ['0', '1'])->nullable();

            $table->foreign('id_user')->references('id_user')->on('user_login')->onDelete('set null');
            $table->foreign('id_opd')->references('id_opd')->on('tabel_referensi_opd')->onDelete('set null');
            $table->foreign('created_by')->references('id_user')->on('user_login')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabel_api');
    }
};
