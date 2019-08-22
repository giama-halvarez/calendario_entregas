<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoOperacion extends Model
{
    //
    public function get_tipos(){
    	$lista = array();

    	$t = new TipoOperacion;
    	$t->id = 1;
    	$t->nombre = 'Plan de Ahorro';

    	$lista[] = $t;

    	$t = new TipoOperacion;
    	$t->id = 2;
    	$t->nombre = 'Convencional';

    	$lista[] = $t;

    	return $lista;
    }
}
