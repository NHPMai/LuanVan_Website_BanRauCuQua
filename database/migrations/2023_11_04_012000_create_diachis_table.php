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
        Schema::create('diachis', function (Blueprint $table) {
            $table->id();
            $table->string('dc_diachi');
            $table->integer('dc_trangthai');
            $table->integer('macdinh');
            $table->foreign('khachhang_id')
                ->references('id')
                ->on('khachhangs')
                ->onDelete('cascade');
            $table->foreign('xa_phuong_thitran_id')
                ->references('id')
                ->on('thanhphos')
                ->onDelete('cascade');
            $table->foreign('quan_huyen_id')
                ->references('id')
                ->on('quan_huyens')
                ->onDelete('cascade');
            $table->foreign('tinh_thanhpho_id')
                ->references('id')
                ->on('tinh_thanhphos')
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
        Schema::dropIfExists('diachis');
    }
};
