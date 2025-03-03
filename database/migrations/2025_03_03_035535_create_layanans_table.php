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
     public function up()
     {
         Schema::create('tabel_layanan', function (Blueprint $table) {
             $table->id();
             $table->string('nama_layanan');
             $table->text('isi_layanan');
             $table->timestamp('edited')->default(DB::raw('CURRENT_TIMESTAMP'));
             $table->timestamp('added')->default(DB::raw('CURRENT_TIMESTAMP'));
             $table->unsignedBigInteger('add_by');
             $table->unsignedBigInteger('edit_by');
             $table->foreign('add_by')->references('id_user')->on('user_login')->onDelete('cascade');
             $table->foreign('edit_by')->references('id_user')->on('user_login')->onDelete('cascade');
         });
     }
 
     public function down()
     {
         Schema::dropIfExists('tabel_layanan');
     }
};
