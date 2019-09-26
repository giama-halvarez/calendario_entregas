<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Marca;
use App\SedeEntrega;
use App\Observacion;

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
                            'otros_accesorios',
                            'estado',
                            'usuario_alta',
                            'fecha_alta_reprogramacion',
                            'vendedor',
                            ];

    public function marca(){
    	return $this->belongsTo(Marca::class);
    }

    public function sede_entrega(){
    	return $this->belongsTo(SedeEntrega::class);
    }

    public function accesorios(){
    	return $this->belongsToMany(Accesorio::class, 'operaciones_accesorios');
    }

    public function observaciones(){
        return $this->hasMany(Observacion::class);
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

    public function fecha_entrega($formato = 'd-m-Y'){
        return date($formato, strtotime($this->fecha_calendario_entrega));
    }

    public function hora_entrega($formato = 'H:i'){
        return date($formato, strtotime($this->fecha_calendario_entrega));
    }

    public function fecha_calendario_entrega_format($formato = 'd-m-Y h:i A'){
        if ($this->fecha_calendario_entrega) {
            return date($formato, strtotime($this->fecha_calendario_entrega));
        }
        else{
            return '';
        }        
    }

    public function created_at_format($formato = 'd-m-Y h:i A'){
        if ($this->created_at) {
            return date($formato, strtotime($this->created_at));
        }
        else{
            return '';
        }        
    }

    public function fecha_alta_reprogramacion_format($formato = 'd-m-Y h:i A'){
        if ($this->fecha_alta_reprogramacion) {
            return date($formato, strtotime($this->fecha_alta_reprogramacion));
        }
        else{
            return '';
        }        
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

    public function accesorios_mostrar(){
        if (count($this->accesorios) > 0) {
            $res = '';
            foreach ($this->accesorios as $accesorio) {
                $res .= $accesorio->nombre . ' ; ';
            }
            return substr($res, 0, strlen($res)-3);
        }
        else{
            return '';
        }
    }

    private function differenceInHours($startdate,$enddate){
        $starttimestamp = strtotime($startdate);
        $endtimestamp = strtotime($enddate);
        $difference = ($endtimestamp - $starttimestamp)/3600;
        
        return $difference;
    }

}
