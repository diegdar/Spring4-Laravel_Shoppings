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
            'purchase_date'=>'date',
            'quantity'=>'required|decimal:0',
            'amount'=>'required|decimal:2',
            'supermarket'=>'required|string',
            'product_id'=>'required|string',
        ];
    }
    public function messages(): array //note 3 
    {
        return[
            // purchase_date
                'purchase_date.date'=>'Formato fecha admitido: dd/mm/aaaa',
            // quantity
                'quantity.required'=> 'Este campo es obligatorio',
                'quantity.decimal'=> 'Solo se admite numeros enteros',
            // amount
                'amount.required'=> 'Este campo es obligatorio',
                'amount.decimal'=> 'Solo se admite numeros con 2 decimales',
            // supermarket
                'supermarket.required'=> 'Este campo es obligatorio',
                'supermarket.string'=> 'Se admite solo letras',
            // product_id
                'product_id.required'=>'Este campo es obligatorio',
                'product_id.string'=> 'Se admite solo letras',
        ];
    }

}
