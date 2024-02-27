<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpsertProductRequest extends FormRequest
{
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|max:200',
            'description' => 'required|max:600',
            'amount' => 'required|integer|min:0',
            'price' => 'required|numeric|between:0,999999.99',
            'image' => 'nullable|image|mimes:png,jpg',
            'category_id' => 'nullable|integer|min:0',
        ];
    }

//    public function messages()
//    {
//        return [
//            'name.required' => 'Jest wymagane pole :attribute!',
//        ];
//    }
//
//    public function attributes()
//    {
//        return [
//            'name' => 'nazwa produktu',
//        ];
//    }

}
