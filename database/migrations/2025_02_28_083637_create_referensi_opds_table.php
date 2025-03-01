<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tabel_referensi_opd', function (Blueprint $table) {
            $table->id('id_opd');
            $table->string('nama_opd', 255);
            $table->timestamp('edited')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('added')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('is_delete')->nullable();
            $table->unsignedBigInteger('add_by');
            $table->unsignedBigInteger('edit_by');
            $table->unsignedBigInteger('delete_by')->nullable();
            $table->enum('is_active', ['1', '2'])->comment('1: aktif, 2: non aktif');
            
            $table->foreign('add_by')->references('id_user')->on('user_login');
            $table->foreign('edit_by')->references('id_user')->on('user_login');
            $table->foreign('delete_by')->references('id_user')->on('user_login');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabel_referensi_opd');
    }
};
