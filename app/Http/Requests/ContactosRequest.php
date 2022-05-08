<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactosRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->empresa_id == session('empresa')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $contacto = $this->route()->parameter('contacto');

        $rules = [
            'nombre' => 'required',
            'flotas_id' => 'required',
            'telefono' => 'nullable|digits_between:6,9|numeric',

        ];

        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'nombre.required' => 'No dejes vacio este campo',
            'flotas_id.required' => 'Ingresa una flota',
            'telefono.digits_between' => 'Ingresa como maximo 9 caracteres numericos',
            'telefono.numeric' => 'El numero de telefono debe ser un numero',

        ];
    }
}
