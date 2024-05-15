<?php

namespace App\Http\Requests\transaksi;

use Illuminate\Foundation\Http\FormRequest;

class bayarrequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'kelas'        => 'required',
            'nominal'      => 'required',
        ];
    }
}
