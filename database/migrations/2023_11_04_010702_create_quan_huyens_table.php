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
        Schema::create('quan_huyens', function (Blueprint $table) {
            $table->id();
            $table->string('qh_ten');
            $table->string('qh_loai');
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
        Schema::dropIfExists('quan_huyens');
    }
};
