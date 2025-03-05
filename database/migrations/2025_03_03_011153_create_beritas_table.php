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
        Schema::create('tabel_berita', function (Blueprint $table) {
            $table->integer('id_berita')->autoIncrement();
            $table->string('judul', 250)->nullable();
            $table->text('isi')->nullable();
            $table->string('slug', 255)->nullable();
            $table->string('thumbnail_url', 255)->nullable();
            $table->timestamp('added')->useCurrent();
            $table->timestamp('edited')->useCurrent();
            $table->integer('add_by');

            $table->foreign('add_by')->references('id_user')->on('user_login')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabel_berita');
    }
};
