<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Operacion;
use App\SedeEntrega;

class OperacionHoraSedeEntregaRepetidoRule implements Rule
{
    private $sede_entrega = 0;
    private $hora_entrega;
    private $operacion = 0;
    /**
     * Create a new rule instance.
     *
     * @param  string  $sede
     * @param  mixed  $hora
     * @param  mixed  $value
     * @return void
     */
    public function __construct($sede, $hora, $operacion_id = 0)
    {
        //
        $this->sede_entrega = $sede;
        $this->hora_entrega = $hora;
        $this->operacion = $operacion_id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Sede, Fechas y Estado pendiente
        $fecha = \DateTime::createFromFormat('d/m/Y h:i A', $this->hora_entrega);

        $horaDesde = \DateTime::createFromFormat('d/m/Y h:i A', $this->hora_entrega);
        $horaHasta = \DateTime::createFromFormat('d/m/Y h:i A', $this->hora_entrega);

        date_add($horaDesde, date_interval_create_from_date_string('-30 minutes'));
        date_add($horaHasta, date_interval_create_from_date_string('30 minutes'));

        $operaciones = Operacion::where('fecha_calendario_entrega', '>', $horaDesde)->where('fecha_calendario_entrega','<', $horaHasta)->where('sede_entrega_id','=', $this->sede_entrega)->where('estado','=',0)->where('id','!=',$this->operacion)->get();
        
        if (count($operaciones) > 0) {
            return false;
        }
        else{
            return true;
        }
        
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Hay una entrega existente que se superpone con el horario seleccionado';
    }
}
