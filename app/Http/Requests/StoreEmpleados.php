<?php

namespace App\Http\Requests;

use App\Http\Rules\NifNie;
use Illuminate\Foundation\Http\FormRequest;
//Se agrega personalizada del NifNie
use App\Http\Rules\NifNie;

class StoreEmpleados extends FormRequest
{
    
   // public function __construct(validationFactory $validationfactory)
   // {

    //}

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
            'numero_dni_nie' => ['required|unique:empleado' , new NifNie()],
            'fecha_nacimiento' => 'required',

        ];
    }
}
