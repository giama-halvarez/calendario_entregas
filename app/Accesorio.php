<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\OperacionAccesorio;

class Accesorio extends Model
{
    //
    protected $table = 'accesorios';
    protected $connection = 'mysql_calendar';
    protected $fillable = [ 'nombre',
                            'activo',
                            ];

    public function encuentraAccesorio($listado){
    	foreach($listado as $op_accesorio){
    		if ($op_accesorio->id == $this->id) {
    			return true;
    		}
    	}

    	return false;
    }
}
