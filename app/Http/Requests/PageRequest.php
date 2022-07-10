<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
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
            'slug' => ['required', Rule::unique('pages')->ignore($this->id)],
            'tags_ru' => 'array|nullable',
            'tags_uk' => 'array|nullable',
            'text_ru' => 'string|nullable',
            'text_uk' => 'string|nullable',
            'description_ru' => 'string|nullable',
            'description_uk' => 'string|nullable',
            'visible' => 'boolean|nullable',
        ];
    }
}
