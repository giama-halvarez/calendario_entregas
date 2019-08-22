<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Marca;
use App\SedeEntrega;

class Operacion extends Model
{
    //
    protected $table = 'operaciones';
    protected $connection = 'mysql_calendar';
    protected $fillable = ['chasis',
                            'tipo_operacion',
                            'nro_preventa',
                            'grupo',
                            'orden',
                            'marca_id',
                            'modelo',
                            'color',
                            'vin',
                            'nombre',
                            'apellido',
                            'telefono1',
                            'telefono2',
                            'telefono3',
                            'email',
                            'semaforo',
                            'fecha_calendario_entrega',
                            'sede_entrega_id',
                            'estado',
                            ];

    public function marca(){
    	return $this->belongsTo(Marca::class);
    }

    public function sede_entrega(){
    	return $this->belongsTo(SedeEntrega::class);
    }

    public function accesorios(){
    	return $this->hasMany(Accesorio::class);
    }

    public function tipo_operacion_nombre(){
        switch ($this->tipo_operacion) {
            case 1:
                return 'Plan de Ahorro';
                break;
            case 2:
                return 'Convencional';
                break;
            default:
                return '';
                break;
        }
    }

    public function estado_nombre(){
        switch ($this->estado) {
            case 0:
                return 'Pendiente';
                break;
            case 1:
                return 'Entregado';
                break;
            default:
                return '';
                break;
        }
    }

    public function semaforo_color(){
        switch ($this->semaforo) {
            case 0:
                return 'Verde';
                break;
            case 1:
                return 'Amarillo';
                break;
            case 2:
                return 'Rojo';
                break;
            default:
                return '';
                break;
        }
    }

    public function fecha_entrega(){
        return date('d-m-Y', strtotime($this->fecha_calendario_entrega));
    }

    public function hora_entrega(){
        return date('H:i', strtotime($this->fecha_calendario_entrega));
    }

    public function ApeNom(){
        if ($this->nombre == '') {            
            return $this->apellido;
        }
        else{
            return $this->apellido . ', ' . $this->nombre;
        }
    }

    public function GrupoOrden(){
        if ($this->grupo != '') {
            return $this->grupo . '-' . str_pad($this->orden, 3, '0', STR_PAD_LEFT);
        }
    }

    public function alerta_entrega(){
        $resultado = $this->differenceInHours($this->fecha_calendario_entrega, now());
        return $resultado;
    }

    private function differenceInHours($startdate,$enddate){
        $starttimestamp = strtotime($startdate);
        $endtimestamp = strtotime($enddate);
        $difference = ($endtimestamp - $starttimestamp)/3600;
        
        return $difference;
}

}
