<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OperacionUpdateRequest extends FormRequest
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
            'nombre'=>'required|max:50',
            'apellido'=>'required|max:50',
            'email'=>'required|email|max:50',
            'telefono1'=>'required|max:50',
            'telefono2'=>'max:50',
            'telefono3'=>'max:50',
            'chasis'=>'required|max:50',
            'vin'=>'required|max:50',
            'modelo'=>'required|max:50',
            'color'=>'max:50',
            'grupo' => 'required_if:tipo_operacion,==,1|numeric',
            'orden' => 'required_if:tipo_operacion,==,1|numeric|min:1|max:240',
            'nro_preventa' => 'required_if:tipo_operacion,==,2|unique:operaciones',
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
