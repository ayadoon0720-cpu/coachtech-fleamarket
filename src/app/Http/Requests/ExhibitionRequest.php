<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExhibitionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
      return [
        'image' => 'required|file|mimes:jpg,jpeg,png',
        'categories' => 'required',
        'condition' => 'required',
        'name' => 'required',
        'description' => 'required',
        'price' => 'required|numeric',
      ];
    }

    public function messages()
    {
        return [

        ];
    }
}
