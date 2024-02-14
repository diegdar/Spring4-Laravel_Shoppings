<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
/*
🗒️NOTAS:
1: Este metodo authorize() se utiliza para indicar que usuarios tienen acceso pero esto ya se puede manejar con la polises por lo que mejor es dejar el return en true.
2: valida los datos recibidos por el formulario.
3: personaliza los mensajes de validacion.
4: personaliza los nombres de los atributos en el formulario.

*/

class StoreProduct extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;// nota 1
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [//nota 2
            'description'=>'required|min:4',
            'unit_price'=>'required',
            'category'=>'required',
        ];
    }
    public function messages(): array //nota 3 
    {
        return[
            'descripcion.required'=> 'La descripcion es obligatoria',
            'unit_price.required'=> 'El precio es obligatorio',
            'category.required'=> 'La categoria es obligatoria',
        ];
    }
    public function attributes():array//nota 4 
    {
        return[
            'description'=>'descripcion del producto',
            'unit_price'=>'precio unitario del producto',
            'category'=>'categoria del producto, pudiendo ser solo: Alimentacion, Higiene personal o Hogar',
        ];
    }


}
