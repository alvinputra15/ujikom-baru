<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;

class userCreateRequest extends FormRequest
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
            'foto_profile'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name'                  => 'required|min:3',
            'nis'                   => 'required|min:9',
            'telepon'               => 'nullable|min:10',
            'alamat'                => 'nullable|max:255',
            'ajaran_kode'           => 'nullable',
            'tingkat_kode'          => 'nullable',
            'kelas_id'              => 'required',
            'email'                 => 'required|email|unique:users,email',
            'level'                 => 'required',
            'password'              => 'required|min:8|confirmed',
            'password_confirmation' => 'required|min:8'
        ];
    }
}
