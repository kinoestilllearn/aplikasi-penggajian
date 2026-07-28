<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePegawaiRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'no_pegawai'     => ['bail', 'required', 'string', 'max:16', 'unique:pegawai,no_pegawai,' . $this->id],
            'nama'           => ['bail', 'required', 'string', 'max:255'],
            'tempat_lahir'   => ['bail', 'required', 'string', 'max:255'],
            'tanggal_lahir'  => ['bail', 'required', 'date'],
            'status_pegawai' => ['bail', 'required', 'string', 'in:tetap,kontrak,HL', 'max:255'],
            'jenis_kelamin'  => ['bail', 'required', 'string', 'in:L,P', 'max:1'],
            'departemen_id'  => ['bail', 'required', 'integer', 'exists:departemen,id'],
            'posisi_id'      => ['bail', 'required', 'integer', 'exists:posisi,id'],
        ];
    }
}
