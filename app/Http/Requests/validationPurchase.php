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

class validationPurchase extends FormRequest
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
            'quantity'=>'required|decimal:0',
            'amount'=>'required|decimal:2',
            'supermarket'=>'required|string',
        ];
    }
    public function messages(): array //note 3 
    {
        return[
            // quantity
                'quantity.required'=> 'Este campo es obligatorio',
                'quantity.min'=> 'Solo se admite numero enteros',
            // amount
                'amount.required'=> 'Este campo es obligatorio',
                'amount.decimal'=> 'Solo se admiten numeros con 2 decimales',
            // supermarket
                'supermarket.required'=> 'Este campo es obligatorio',
                'supermarket.string'=> 'Se admite solo letras',
        ];
    }

}
