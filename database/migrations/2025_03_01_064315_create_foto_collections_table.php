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
        Schema::create('tabel_foto_collection', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_collection');
            $table->string('folder', 255)->nullable();
            $table->text('file');
            $table->timestamp('added')->useCurrent();
            $table->timestamp('edited')->useCurrent();
            $table->unsignedBigInteger('add_by')->nullable();

            $table->foreign('id_collection')->references('id_collection')->on('tabel_collection')->onDelete('cascade');
            $table->foreign('add_by')->references('id_user')->on('user_login')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabel_foto_collection');
    }
};
