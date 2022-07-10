<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FilterRequest extends FormRequest
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
            'slug' => ['required', 'min:3',Rule::unique('filters')->ignore($this->id)],
            'filter_id' => 'nullable',
            'visible' => 'boolean',
            'fields' => 'array',
            'fields.*.slug' => 'required_with:fields|min:3|unique:filters',
            'fields.*.value_ru' => 'required_with:fields|min:3|unique:filters',
            'fields.*.value_uk' => 'required_with:fields|min:3|unique:filters',
        ];
    }
}
