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
        Schema::create('tabel_referensi_icon', function (Blueprint $table) {
            $table->id('id_icon');
            $table->string('nama_icon', 255);
            $table->unsignedBigInteger('id_opd')->nullable();
            $table->timestamp('edited')->useCurrent();
            $table->timestamp('added')->useCurrent();
            $table->timestamp('is_delete')->nullable();
            $table->unsignedBigInteger('add_by');
            $table->unsignedBigInteger('edit_by');
            $table->unsignedBigInteger('delete_by')->nullable();
            $table->enum('is_active', ['1', '2'])->default('1');
            
            $table->foreign('id_opd')->references('id_opd')->on('tabel_referensi_opd')->onDelete('set null');
            $table->foreign('add_by')->references('id_user')->on('user_login')->onDelete('cascade');
            $table->foreign('edit_by')->references('id_user')->on('user_login')->onDelete('cascade');
            $table->foreign('delete_by')->references('id_user')->on('user_login')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabel_referensi_icon');
    }
};
