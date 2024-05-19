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
            'user_id' => 'required', 
            'ajaran_kode' => 'required', 
            'metode_kode' => 'required', 
            'tanggal_transaksi' => 'required', 
            'bulan' => 'required',
            'kelas_id' => 'required',
            'nominal' => 'required',
        ];
    }
}
