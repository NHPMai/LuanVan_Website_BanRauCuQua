<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('giaohangs', function (Blueprint $table) {
            $table->id();
            $table->string('gh_hoten');
            $table->string('avatar')->nullable();
            $table->string('gh_sodienthoai');
            $table->string('gh_gioitinh');
            $table->string('gh_ngaysinh');
            $table->string('gh_diachi');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('gh_trangthai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('giaohangs');
    }
};
