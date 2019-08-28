<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\OperacionFechaRule;
use App\Rules\OperacionHorarioEntregaRule;
use App\Rules\OperacionHoraSedeEntregaRepetidoRule;

class EntregaUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'sede_entrega'=>'required',
            'fecha_calendario_entrega'=>['required', new OperacionFechaRule, new OperacionHorarioEntregaRule, new OperacionHoraSedeEntregaRepetidoRule(request()->sede_entrega, request()->fecha_calendario_entrega, request()->id)],
        ];
    }

    public function messages(){
        return [
        'fecha_calendario_entrega.required' => 'El campo Fecha de Entrega es obligatorio',
        ];
    }
}
