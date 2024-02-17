<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
/*
🗒️NOTES:
1: This authorize() method is used to indicate which users have access but this can already be handled with the policies so it is better to leave the return true.
2: validates the data received by the form.
3: Customize validation messages.
4: Customize the attribute names on the form.
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
                'quantity.numeric'=> 'Solo se admite numeros enteros',
            // amount
                'amount.required'=> 'Este campo es obligatorio',
                'amount.decimal'=> 'Solo se admite numeros con 2 decimales',
            // supermarket
                'supermarket.required'=> 'Este campo es obligatorio',
                'supermarket.string'=> 'Se admite solo letras',
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
