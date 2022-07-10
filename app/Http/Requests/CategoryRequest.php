<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
            'slug' => ['required', 'min:3',Rule::unique('categories')->ignore($this->id)],
            'category_id' => 'integer|nullable',
            'filters' => 'array|nullable',
            'scidka' => 'float|nullable',
            'position' => 'integer|nullable',
            'tags_ru' => 'array|nullable',
            'tags_uk' => 'array|nullable',
            'description_ru' => 'string',
            'description_uk' => 'string',
            'visible' => 'boolean',
            'img' => 'nullable|string'//|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
