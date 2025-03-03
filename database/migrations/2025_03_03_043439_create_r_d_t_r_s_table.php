<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('db_rdtr', function (Blueprint $table) {
            $table->string('nilai_kolom_unik', 255)->nullable();
            $table->text('kdb')->nullable();
            $table->text('klb')->nullable();
            $table->text('kdh')->nullable();
            $table->text('gsb')->nullable();
            $table->text('ktb')->nullable();
            $table->text('ktgbgn')->nullable();
            $table->text('bgnizn')->nullable();
            $table->text('bgntbt')->nullable();
            $table->text('bgnbst')->nullable();
            $table->text('bgntbs')->nullable();
            $table->text('ketrgn')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('db_rdtr');
    }
};
