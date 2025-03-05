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
        Schema::create('log_berita', function (Blueprint $table) {
            $table->integer('id_log_berita')->autoIncrement();
            $table->integer('id_berita');
            $table->enum('activity', ['menambahkan', 'mengubah'])->default('menambahkan');
            $table->timestamp('tgl')->useCurrent();
            $table->integer('add_by');

            $table->foreign('id_berita')->references('id_berita')->on('tabel_berita')->onDelete('cascade');
            $table->foreign('add_by')->references('id_user')->on('user_login')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_berita');
    }
};
