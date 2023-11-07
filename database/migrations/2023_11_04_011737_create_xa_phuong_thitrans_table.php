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
        Schema::create('xa_phuong_thitrans', function (Blueprint $table) {
            $table->id();
            $table->string('xa_ten');
            $table->string('xa_loai');
            $table->foreign('quan_huyen_id')
                ->references('id')
                ->on('quan_huyens')
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
        Schema::dropIfExists('xa_phuong_thitrans');
    }
};
