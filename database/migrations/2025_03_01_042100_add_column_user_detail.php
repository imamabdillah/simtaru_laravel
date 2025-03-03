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
        //
        Schema::table('user_detail', function (Blueprint $table) {
            $table->unsignedBigInteger('ditambahkan_oleh');
            $table->unsignedBigInteger('diupdate_oleh');
            $table->unsignedBigInteger('dihapus_oleh')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('user_detail', function (Blueprint $table) {
            $table->dropColumn('ditambahkan_oleh');
            $table->dropColumn('diupdate_oleh');
            $table->dropColumn('dihapus_oleh');
        });
    }
};
