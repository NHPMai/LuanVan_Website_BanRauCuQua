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
        Schema::create('nhanviens', function (Blueprint $table) {
            $table->id();
            $table->string('hoten');
            $table->string('avata',255);
            $table->string('sodienthoai', 255);
            $table->string('email')->unique();
            $table->string('gioitinh',255);
            $table->date('ngaysinh');
            $table->string('diachi', 255);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->integer('hoatdong');
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
        Schema::dropIfExists('nhanviens');
    }
};
