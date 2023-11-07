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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('ten');
            $table->integer('gia');
            $table->text('mota');
            $table->longText('noidung');
            $table->string('hinhanh');
            $table->integer('soluongsp');
            $table->integer('soluongban');
            $table->integer('hoatdong');
            $table->integer('luotxem');
            $table->unsignedBigInteger('menu_id');
            $table->unsignedBigInteger('brand_id');
            $table->foreign('menu_id')
                ->references('id')
                ->on('menus')
                ->onDelete('cascade');
            $table->foreign('brand_id')
                ->references('id')
                ->on('brands')
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
        Schema::dropIfExists('products');
    }
};
