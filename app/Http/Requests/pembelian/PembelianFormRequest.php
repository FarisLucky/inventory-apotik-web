<?php

namespace App\Http\Requests\pembelian;

use Illuminate\Foundation\Http\FormRequest;

class PembelianFormRequest extends FormRequest
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
            'obat' => 'required|numeric',
            'harga_beli' => 'required|numeric',
            'jumlah' => 'required|numeric',
            'diskon' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute tidak boleh kosong'
        ];
    }
}
