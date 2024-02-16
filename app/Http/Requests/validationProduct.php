<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
/*
🗒️noteS:
1: Este metodo authorize() se utiliza para indicar que usuarios tienen acceso pero esto ya se puede manejar con la polises por lo que mejor es dejar el return en true.
2: valida los datos recibidos por el formulario.
3: personaliza los mensajes de validacion.
4: personaliza los nombres de los atributos en el formulario.

*/

class validationProduct extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;// note 1
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [//note 2
            'description'=>'required|regex:/^[a-zA-Zñáéíóú]+$/|min:4',
            'unit_price'=>'required|decimal:2',
            'category'=>'required|string|in:Alimentacion,Limpieza,Higiene personal,Hogar',
        ];
    }
    public function messages(): array //note 3 
    {
        return[
            // description
                'description.required'=> 'Este campo es obligatorio',
                'description.min'=> 'Debe tener al menos 4 letras',
                'description.regex'=> 'Se admite solo letras',
            // unit_price
                'unit_price.required'=> 'Este campo es obligatorio',
                'unit_price.decimal'=> 'Solo se admiten numeros con 2 decimales',
            // category
                'category.required'=> 'Este campo es obligatorio',
                'category.string'=> 'Se admite solo letras',
                'category.in'=> 'Debes escoger un valor',
        ];
    }
    public function attributes():array//note 4 
    {
        return[
            'description'=>'descripcion del producto',
            'unit_price'=>'precio unitario del producto',
            'category'=>'categoria del producto, pudiendo ser solo: Alimentacion, Higiene personal o Hogar',
        ];
    }


}
