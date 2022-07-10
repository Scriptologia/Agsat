<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleRequest extends FormRequest
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
            'name' => ['required', 'min:5',Rule::unique('roles')->ignore($this->id)],
            'slug' => ['required', 'min:5',Rule::unique('roles')->ignore($this->id)],
            'permissions' => 'array',
            'description' => 'string|nullable',
        ];
    }
}