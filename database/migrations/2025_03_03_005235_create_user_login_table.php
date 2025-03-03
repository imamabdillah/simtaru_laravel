<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
       Schema::create('user_login', function (Blueprint $table) {
        $table->id('id_user'); // Pastikan primary key adalah id_user
        $table->string('user_name')->unique();
        $table->string('user_pass');
        $table->timestamps();
    });

    }

    public function down()
    {
        Schema::dropIfExists('user_login');
    }
};
