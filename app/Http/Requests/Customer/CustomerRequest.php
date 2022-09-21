<?php

namespace App\Http\Requests\Customer;

use App\Models\Query\Customer\Customer;
use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            'name' => 'required|string|max:150',
            'gender' => 'required|string|max:150',
            'age' => 'required|integer',
            'status' => 'required|integer'
        ];    
    }

    public function update()
    {  
        return [
            'name' => 'string|max:150',
            'gender' => 'string|max:150',
            'age' => 'integer',
            'status' => 'integer'
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
            'name' => 'Invalid Customer',
            'gender' => 'gender'
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
        });
        */
    }
}
