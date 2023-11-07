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
        Schema::create('phivanchuyens', function (Blueprint $table) {
            $table->id();
            $table->integer('pvc_phivanchuyen');
            $table->foreign('tinh_thanhpho_id')
                ->references('id')
                ->on('tinh_thanhphos')
                ->onDelete('cascade');
            $table->foreign('quan_huyen_id')
                ->references('id')
                ->on('quan_huyens')
                ->onDelete('cascade');
            $table->foreign('xa_phuong_thitran_id')
                ->references('id')
                ->on('xa_phuong_thitrans')
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
        Schema::dropIfExists('phivanchuyens');
    }
};
