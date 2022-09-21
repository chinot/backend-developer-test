<?php

namespace App\Http\Requests\Supply;

use App\Models\Query\Supply\Supply;
use Illuminate\Foundation\Http\FormRequest;

class SupplyRequest extends FormRequest
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
            'supply' => 'required|string|max:150|unique:supplies',
            'points' => 'required|integer'
        ];    
    }

    public function update()
    {  
        return [
            'supply' => 'string|max:150|unique:supplies',
            'points' => 'integer'
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
            'supply' => 'Invalid Supply',
            'points' => 'Password is required!'
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
