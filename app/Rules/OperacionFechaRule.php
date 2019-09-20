<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class OperacionFechaRule implements Rule
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
        //CHEQUEO FECHA POSTERIOR A 48 HS
            
        if (auth()->user()->isSupervisor() == true || auth()->user()->isAdmin() == true) {
            return true;
        }

        $fecha = \DateTime::createFromFormat('d/m/Y h:i A', $value);
        $fecha = strtotime($fecha->format('Y-m-d H:i'));
        $fecha_actual = strtotime(now());

        if ((($fecha - $fecha_actual)/3600) < 48) {
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
        return 'La fecha de entrega no se puede programar con menos de 48hs. de anticipación';
    }

}
