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
        Schema::create('menu_dipesan', function (Blueprint $table) {
            $table->bigInteger('id_pesanan')->unsigned();
            $table->bigInteger('id_menu')->unsigned();
            $table->integer('jumlah');
            $table->integer('harga_peritem');
            $table->timestamps();

            $table->foreign('id_pesanan')->references('id_pesanan')->on('pesanan');
            $table->foreign('id_menu')->references('id_menu')->on('menu');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_dipesan');
    }
};