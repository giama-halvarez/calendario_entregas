<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\SedeEntrega;

class OperacionHoraSedeEntregaRepetidoRule implements Rule
{
    private $sede_entrega = 0;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($sede)
    {
        //
        $this->sede_entrega = $sede;
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
        $sedes_entrega = SedeEntrega::where('activo','=',1)->orderBy('nombre')->get();

        foreach ($sedes_entrega as $s) {
            if ($s->id == $this->sede_entrega) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
