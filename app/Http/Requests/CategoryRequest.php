<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        $id=$this->route('category');
        return Category::rules($id);
    }
    public function messages()
    {
        return [
            'required'=>'this :attribute is necessary',
            'unique'=>'this :attribute is already exists',

        ];
    }
}
