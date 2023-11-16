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
        Schema::create('phieunhaps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nhanvien_id');
            $table->unsignedBigInteger('nhacungcap_id');
            $table->string('pn_ghichu');
            $table->timestamp('pn_ngaylapphieu');
            $table->timestamp('pn_ngayxacnhan');
            $table->integer('pn_tongtiennhap');
            $table->foreign('nhanvien_id')
                ->references('id')
                ->on('nhanviens')
                ->onDelete('cascade');
            $table->foreign('nhacungcap_id')
                ->references('id')
                ->on('nhacungcaps')
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
        Schema::dropIfExists('phieunhaps');
    }
};
