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
        Schema::create('chitietphieunhaps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('phieunhap_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('ctpn_soluong');
            $table->integer('ctpn_gianhap');
            $table->foreign('phieunhap_id')
                ->references('id')
                ->on('phieunhaps')
                ->onDelete('cascade');
            $table->foreign('product_id')
            ->references('id')
            ->on('products')
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
        Schema::dropIfExists('chitietphieunhaps');
    }
};
