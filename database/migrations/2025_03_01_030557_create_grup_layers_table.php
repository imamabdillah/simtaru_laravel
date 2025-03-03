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
        Schema::create('tabel_grup_layer', function (Blueprint $table) {
            $table->id('id_grup_layer');
            $table->string('nama_grup_layer', 255)->nullable();
            $table->foreignId('id_opd')->nullable()->constrained('tabel_referensi_opd', 'id_opd')->nullOnDelete();
            $table->foreignId('id_user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabel_grup_layer');
    }
};
