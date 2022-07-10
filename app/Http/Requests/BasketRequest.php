<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BasketRequest extends FormRequest
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
            'products' => 'array|required',
            'person' => 'array|required',
            'person.name' => 'string|required',
            'person.surname' => 'string|required',
            'person.patronymico' => 'string|required',
            'person.phone' => 'string|required',
            'person.city' => 'string|required',
            'person.region' => 'string|required',
            'person.post' => 'string|required',
            'is_closed' => 'boolean|nullable',
        ];
    }
}
