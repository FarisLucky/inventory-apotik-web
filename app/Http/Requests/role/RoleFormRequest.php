<?php

namespace App\Http\Requests\role;

use Illuminate\Foundation\Http\FormRequest;

class RoleFormRequest extends FormRequest
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
        if ($this->isMethod("POST")) {
            return [
                "permission" => "required|array",
                "role" => "required",
            ];
        } elseif ($this->isMethod("PUT")) {
            return [
                "permission" => "required|array"
            ];
        }
        return false;
    }

    public function messages()
    {
        return [
            "required" => ":attribute tidak boleh kosong",
            "numeric" => ":attribute harus diisi dengan benar"
        ];
    }
}
