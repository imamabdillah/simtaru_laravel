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
        Schema::create('tabel_perbaikan', function (Blueprint $table) {
            $table->integer('id_perbaikan')->autoIncrement();
            $table->unsignedBigInteger('id_data')->nullable();
            $table->text('paket_pekerjaan');
            $table->bigInteger('anggaran')->nullable();
            $table->string('sumber_dana', 255)->nullable();
            $table->string('pelaksana', 255)->nullable();
            $table->string('no_kontrak', 255)->nullable();
            $table->bigInteger('nilai_kontrak')->nullable();
            $table->date('tgl_kontrak')->nullable();
            $table->integer('jangka_waktu')->nullable();
            $table->date('tgl_mulai')->nullable();
            $table->date('tgl_selesai')->nullable();
            $table->integer('tahun')->nullable();
            $table->bigInteger('realisasi')->nullable();
            $table->enum('is_active', ['1', '0'])->default('0');
            $table->timestamps();
            $table->text('created_by')->nullable();
            $table->text('updated_by')->nullable();
            $table->softDeletes();
            $table->text('deleted_by')->nullable();
            $table->text('lokasi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabel_perbaikan');
    }
};
