<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserPutFormRequest extends FormRequest
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
            'name' => 'required',
            'username' => "required",
            'email' => "required|email",
            'role' => "required"
        ];
    }

    public function messages()
    {
        return [
            'email' => ":attribute diisi dengan email yang benar",
            'required' => ":attribute tidak boleh kosong"
        ];
    }
}
