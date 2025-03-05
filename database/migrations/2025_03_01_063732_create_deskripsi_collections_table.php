<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tabel_diskripsi_collection', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('id_collection');
            $table->string('nama', 255)->nullable();
            $table->string('website', 255)->nullable();
            $table->text('deskripsi')->nullable();
            $table->timestamp('added')->useCurrent();
            $table->timestamp('edited')->useCurrent();
            $table->integer('add_by')->nullable();

            $table->foreign('id_collection')->references('id_collection')->on('tabel_collection')->onDelete('cascade');
            $table->foreign('add_by')->references('id_user')->on('user_login')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabel_diskripsi_collection');
    }
};
