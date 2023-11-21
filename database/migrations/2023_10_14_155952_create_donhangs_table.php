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
        Schema::create('donhangs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nhanvien_id');
            $table->unsignedBigInteger('khachhang_id');
            $table->unsignedBigInteger('magiamgia_id');
            $table->unsignedBigInteger('phuongthucthanhtoan_id');
            $table->dateTime('dh_thoigiandathang');
            $table->string('dh_diachigiaohang');
            $table->integer('dh_thanhtien');
            $table->string('dh_trangthai');
            $table->string('dh_ghichu');
            $table->foreign('magiamgia_id')
                ->references('id')
                ->on('magiamgias')
                ->onDelete('cascade');
            $table->foreign('phuongthucthanhtoan_id')
                ->references('id')
                ->on('phuongthucthanhtoans')
                ->onDelete('cascade');
            $table->foreign('nhanvien_id')
                ->references('id')
                ->on('nhanviens')
                ->onDelete('cascade');
            $table->foreign('khachhang_id')
                ->references('id')
                ->on('khachhangs')
                ->onDelete('cascade');
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
        Schema::dropIfExists('donhangs');
    }
};
