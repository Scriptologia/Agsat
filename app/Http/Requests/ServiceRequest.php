<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
            'price' => 'numeric|nullable',
            'text_ru' => 'string|nullable',
            'text_uk' => 'string|nullable',
            'visible' => 'boolean|nullable',
            'curs_id' => 'integer|nullable',
        ];
    }
}
