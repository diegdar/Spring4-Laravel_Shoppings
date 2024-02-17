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
