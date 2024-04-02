<?php

namespace App\Http\Requests;

use App\Http\Rules\NifNie;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Factory as ValidationFactory;
//Se agrega personalizada del NifNie


class StoreEmpleados extends FormRequest{

    public function __construct(ValidationFactory $validationfactory)
    {
        //Validamos la letra del nif
        $validationfactory->extend(
            'nifnie',
            function($attrribute, $value, $parameters){
                $nifnie= new NifNie;
                if($nifnie->isValidNif($value) || $nifnie->isValidNie($value)){
                    return true;
                }
                return false;

            }
        );
    }

    
  
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
            'nss'               => 'required|unique:empleado|min:11|max:12',
            //verificamos con validación personalizada el dni o nie
            'nifnie'            => 'required|unique:empleado|nifnie',
            'fecha_nacimiento'  => 'required',
            'nombre'            => 'required|min:3|max:40',
            'apellidos'         => 'required|min:3|max:40',
            'tipo_via'          => 'required|min:3|max:30',
            'nombre_via'        => 'required|min:3|max:40',
            'numero'            => 'required|integer|min:1|max:3',
            'municipio'         => 'required|min:3|max:40',
            'cp'                => 'required|min:5|max:5',
            'provincia'         => 'required|min:3|max:40',
            'telefono'          => 'nullable|numeric|digits:9',
            'telefono_movil'    => 'nullable|numeric|digits:9',
            'puesto'            => 'required|min:5|max:100',
            'tipo'              => 'required|min:4|max:100',
            'situacion_laboral' => 'required|min:5|max:100',
            'fecha_alta'        => 'required|date_format:Y-m-d',
            'fecha_nacimiento'  => 'date_format:Y-m-d',
            //'fecha_alta'        => 'required|date_format:d/m/Y',
            //'fecha_nacimiento'  => 'date_format:d/m/Y',
            'comentarios'       => 'max:200',
            'imagen'            => 'required|file|mimes:jpg,jpeg,png|max:64'
            

        ];
    }
}
