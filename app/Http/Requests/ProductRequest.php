<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name_ru' => 'required|min:3',
            'name_uk' => 'required|min:3',
            'slug' => ['required', Rule::unique('products')->ignore($this->id)],
            'fields' => 'array|nullable',
            'scidka' => 'numeric|nullable',
            'price' => 'numeric|nullable',
            'category_id' => 'array|nullable',
            'service_id' => 'integer|nullable',
            'tags_ru' => 'array|nullable',
            'tags_uk' => 'array|nullable',
            'text_ru' => 'string|nullable',
            'text_uk' => 'string|nullable',
            'description_ru' => 'string|nullable',
            'description_uk' => 'string|nullable',
            'visible' => 'boolean|nullable',
            'curs_id' => 'integer|nullable',
            'id' => 'integer|nullable',
            'dop_products' => 'array|nullable',
            'img' => 'nullable|array'//|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
    public function messages()
    {
        return [
//            'slug.unique' => 'Slug уже занят',
        ];
    }
}
