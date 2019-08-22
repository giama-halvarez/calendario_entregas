<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperacionesAccesoriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operaciones_accesorios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('operacion_id');
            $table->unsignedBigInteger('accesorio_id');
            $table->timestamps();

            $table->foreign('operacion_id')->references('id')->on('operaciones'); 
            $table->foreign('accesorio_id')->references('id')->on('accesorios');     

            $table->unique(['operacion_id', 'accesorio_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('operaciones_accesorios');
    }
}
