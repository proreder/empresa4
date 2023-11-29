<?php

namespace App\Http\Requests;

use App\Http\Rules\NifNie;
use Illuminate\Foundation\Http\FormRequest;

class StoreEmpleados extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * el return se deja en true para autorizar cualquier usuario
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        
        return [
            'nss' => 'required|unique:empleado|integer|min:11|max:12',
            //verificamos con validación personalizada el dni o nie
            'numero_dni_nie' => ['required' , new NifNie()],
            'fecha_nacimiento' => 'required',

        ];
    }
}
