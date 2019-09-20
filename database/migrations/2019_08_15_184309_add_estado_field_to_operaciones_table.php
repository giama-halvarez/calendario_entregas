<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEstadoFieldToOperacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('operaciones', function (Blueprint $table) {
            //
            $table->text('otros_accesorios')->nullable()->after('sede_entrega_id');
            $table->unsignedInteger('estado')->default(0)->after('otros_accesorios'); //0=PENDIENTE,1=ENTREGADO
            $table->string('usuario_alta')->nullable()->after('estado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('operaciones', function (Blueprint $table) {
            //
        });
    }
}
