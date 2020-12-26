<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{

    protected $requried=     'required |';

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
            'category'=>'required||max:25',
        ];
    }

    public function messages(){
        return [
            'category.required' => 'category name should be provided!',
            'category.max' => 'category name should not be grater than 45 charats!',
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
