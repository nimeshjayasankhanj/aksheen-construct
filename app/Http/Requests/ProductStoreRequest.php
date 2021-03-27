<?php

namespace App\Http\Requests;

use App\Product;
use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    protected $requested='required |';
    /**
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
     * @return array
     */
    public function rules()
    {
        return [
            'category'=>'required',
            'pName'=>'required||max:150',
            'cPrice'=>'required||min:1',
            'sPrice'=>'required||min:1'
        ];
    }

    public function messages()
    {
        return[
            'category.required' => 'Category should be provided!',
            'pName.required' => 'Product name should be provided!',
            'pName.max' => 'Product name should not be grater than 150 charats!',
            'cPrice.required' => 'Cost Price should be provided!',
            'cPrice.max' => 'Cost Price should be greater than 01!',
            'sPrice.required' => 'Selling Price should be provided!',
            'sPrice.max' => 'Selling Price should be greater than 01!',

        ];
    }

    public function withValidator($validator){

        $validator->after(function ($validator) {

            if ($validator->errors()->count() > 0) {
                return;
            }


        });
    }


}
