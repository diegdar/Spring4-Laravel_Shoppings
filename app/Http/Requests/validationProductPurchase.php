<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
/*
🗒️NOTAS:
1: Este método Authorize() se utiliza para indicar qué usuarios tienen acceso, por lo que es mejor dejar el return en true.
2: valida los datos recibidos por el formulario.
3: Personaliza los mensajes de validación.

*/

class validationProductPurchase extends FormRequest
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
            // 'product_id'=>'required',
            // 'quantity' => 'required|numeric',
            // 'unit_price'=>'required|decimal:2',
        ];
    }
    public function messages(): array //nota 3 
    {
        return[
            // product_id
                'product_id.required'=> 'Este campo es obligatorio',
            // quantity
                'quantity.required'=> 'Este campo es obligatorio',
                'quantity.numeric'=> 'Solo se admiten numeros enteros',
            // unit_price
                'unit_price.required'=> 'Este campo es obligatorio',
                'unit_price.decimal'=> 'Solo se admiten numeros con 2 decimales',
        ];
    }

}
