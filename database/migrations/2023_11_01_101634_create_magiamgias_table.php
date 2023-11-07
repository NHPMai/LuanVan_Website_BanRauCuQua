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
        Schema::create('magiamgias', function (Blueprint $table) {
            $table->id();
            $table->string('mgg_tengiamgia');
            $table->string('mgg_magiamgia');
            $table->integer('mgg_soluongma');
            $table->string('mgg_loaigiamgia');
            $table->integer('mgg_giatrigiamgia');
            $table->dateTime('mgg_ngaybatdau');
            $table->dateTime('mgg_ngayketthuc');
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
        Schema::dropIfExists('magiamgias');
    }
};
