<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operaciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('chasis',50)->unique();
            $table->unsignedInteger('tipo_operacion'); //1=PLAN DE AHORRO, 2=CONVENCIONAL
            $table->unsignedInteger('nro_preventa')->nullable()->unique();
            $table->string('grupo',5)->nullable();
            $table->unsignedInteger('orden')->nullable();
            $table->unsignedBigInteger('marca_id');
            $table->string('modelo',50);
            $table->string('color',50)->nullable();
            $table->string('vin',50);
            $table->string('nombre',50);
            $table->string('apellido',50);
            $table->string('telefono1',50)->nullable();
            $table->string('telefono2',50)->nullable();
            $table->string('telefono3',50)->nullable();
            $table->string('email',50)->nullable();
            $table->unsignedInteger('semaforo')->default(1); //0=VERDE, 1=AMARILLO, 2=ROJO
            $table->datetime('fecha_calendario_entrega');
            $table->timestamps();

            $table->foreign('marca_id')->references('id')->on('marcas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('operaciones');
    }
}
