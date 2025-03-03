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
        Schema::create('tabel_collection', function (Blueprint $table) {
            $table->id('id_collection');
            $table->unsignedBigInteger('id_layer')->nullable();
            $table->enum('tipe_layer', ['Point', 'LineString', 'Polygon'])->default('Point');
            $table->string('stroke', 15)->nullable();
            $table->string('stroke_opacity', 15)->nullable();
            $table->integer('stroke_width', false, true)->nullable();
            $table->string('stroke_dash', 255)->nullable();
            $table->string('fill', 15)->nullable();
            $table->string('fill_opacity', 15)->nullable();
            $table->string('icon_name', 255)->nullable();
            $table->boolean('page_detail')->default(0);
            $table->longText('koordinat')->nullable();
            $table->string('name', 255)->nullable();
            $table->string('group', 255)->nullable();
            $table->timestamp('created')->useCurrent();
            $table->timestamp('edited')->useCurrent();
            $table->unsignedBigInteger('add_by');

            $table->foreign('id_layer')->references('id_layer')->on('tabel_layer')->onDelete('set null');
            $table->foreign('add_by')->references('id_user')->on('user_login')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabel_collection');
    }
};
