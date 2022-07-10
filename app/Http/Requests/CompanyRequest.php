<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            'text_ru' => 'string|nullable',
            'text_uk' => 'string|nullable',
            'phones' => 'array|nullable',
            'socials' => 'array|nullable',
            'time' => 'array|nullable',
            'name' => 'required|string',
            'logo' => 'required|string',
        ];
    }
}
