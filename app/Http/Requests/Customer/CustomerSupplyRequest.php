<?php

namespace App\Http\Requests\Customer;

use App\Models\Query\Customer\CustomerSupply;
use Illuminate\Foundation\Http\FormRequest;

class CustomerSupplyRequest extends FormRequest
{
    /*
    * Determine if the user is authorized to make this request.
    *
    * @return bool
    */
   public function authorize()
   {
       return true;
   }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return $this->isMethod('POST') ? $this->store() : $this->update();
    }


    public function store()
    {  
        return [
            //'id' => 'required|string|max:150:|unique:customer_supplies',
            'customerId' => 'required|string',
            'supplyId' => 'required|string',
            'quantity' => 'required|integer',
        ];    
    }

    public function update()
    {  
        return [
            'customerId' => 'string',
            'supplyId' => 'string',
            'quantity' => 'integer',
        ];    
    }


     /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'customerId' => 'Invalid CustomerSupply',
            'productId' => 'Invalid product ID',
            'quantity' => 'Invalid product qty'
        ];
    }
    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        /*
        todo add custom
       
        $validator->after(function ($validator) {
            print_r($validator->errors()); exit;
        });
         */

    }
}
