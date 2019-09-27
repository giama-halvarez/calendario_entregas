<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Observacion extends Model
{
    //
    protected $table = 'observaciones';
    protected $connection = 'mysql_calendar';
    protected $fillable = [ 'operacion_id',
                            'descripcion',
                            'usuario_alta',
                            ];


    public function created_at_format($formato = 'd-m-Y h:i A'){
        return date($formato, strtotime($this->created_at));
    }
    
}
