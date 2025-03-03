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
            $table->id('id_api');
            $table->string('nama_pemohon', 255)->nullable();
            $table->text('token');
            $table->text('akses_layer');
            $table->unsignedBigInteger('id_user')->nullable();
            $table->unsignedBigInteger('id_opd')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->unsignedInteger('deleted_by')->nullable();
            $table->enum('aktif', ['0', '1'])->nullable();

            $table->foreign('id_user')->references('id_user')->on('user_login')->onDelete('set null');
            $table->foreign('id_opd')->references('id_opd')->on('tabel_referensi_opd')->onDelete('set null');
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
