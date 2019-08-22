<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class OperacionHorarioEntregaRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        //
        $d = explode (':', env('PARAMETER_HORARIO_DESDE'));
        $h = explode (':', env('PARAMETER_HORARIO_HASTA'));

        $fecha = \DateTime::createFromFormat('d/m/Y h:i A', $value);

        if ($fecha->format('N') == 7) {
            return false;
        }
        else{

            $horaDesde = \DateTime::createFromFormat('d/m/Y h:i A', $value);
            $horaHasta = \DateTime::createFromFormat('d/m/Y h:i A', $value);

            $horaDesde->setTime($d[0], $d[1]);
            $horaHasta->setTime($h[0], $h[1]);


            if ($fecha >= $horaDesde && $fecha <= $horaHasta) {
                return true;
            }
            else{
                return false;
            }
        }

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El horario seleccionado debe ser de Lunes a Sábados entre ' . env('PARAMETER_HORARIO_DESDE') . ' y ' . env('PARAMETER_HORARIO_HASTA') . ' hs.';
    }
}
