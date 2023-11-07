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
        Schema::create('chitietquyens', function (Blueprint $table) {
            $table->id();
            $table->string('coquyen');
            $table->foreign('nhanvien_id')
                ->references('id')
                ->on('nhanviens')
                ->onDelete('cascade');
            $table->foreign('quyen_id')
                ->references('id')
                ->on('quyens')
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
        Schema::dropIfExists('chitietquyens');
    }
};
