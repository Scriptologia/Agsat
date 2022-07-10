<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
            'name' => 'required|min:3',
            'email' => ['required', 'email', 'min:5',Rule::unique('users')->ignore($this->id)],
            'password' => 'min:8|confirmed|nullable',
            'role_id' => 'integer|nullable',
            'id' => 'integer'
        ];
    }
    public function messages()
    {
        return [
//            'email.unique' => 'Email уже занят',
        ];
    }
}
