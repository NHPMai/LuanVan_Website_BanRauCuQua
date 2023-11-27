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
        Schema::create('thongkes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('tk_ngay');
            $table->integer('tk_soluong');
            $table->decimal('tk_tongtien');
            $table->decimal('tk_loinhuan');
            $table->integer('tk_tongdonhang');
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
        Schema::dropIfExists('thongkes');
    }
};
