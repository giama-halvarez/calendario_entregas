<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConsultaRequest extends FormRequest
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
            'grupo' => 'required_if:tipo_operacion,==,1|numeric',
            'orden' => 'required_if:tipo_operacion,==,1|numeric|min:1|max:241',
            'nro_preventa' => 'required_if:tipo_operacion,==,2',
            //
        ];
    }

    public function messages(){
        return [
        'nro_preventa.required_if' => 'El campo Numero Pre Venta es obligatorio',
        'grupo.required_if' => 'El campo Grupo es obligatorio',
        'orden.required_if' => 'El campo Orden es obligatorio',
        ];
    }
}
