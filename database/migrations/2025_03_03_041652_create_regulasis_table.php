<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tabel_regulasi', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('nama_dokumen', 255);
            $table->date('tanggal_disahkan');
            $table->string('file', 255);
            $table->timestamp('edited')->useCurrent();
            $table->timestamp('added')->useCurrent();
            $table->integer('add_by');
            $table->integer('edit_by');
            
            $table->foreign('add_by')->references('id_user')->on('user_login')->onDelete('cascade');
            $table->foreign('edit_by')->references('id_user')->on('user_login')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tabel_regulasi');
    }
};
