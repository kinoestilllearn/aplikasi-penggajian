<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePenggajianRequest extends FormRequest
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
            'no_ref'                 => ['bail', 'string', 'max:10', 'unique:penggajian,no_ref,' . $this->id],
            'tanggal_mulai'          => ['bail', 'date'],
            'tanggal_hingga'         => ['bail', 'date'],
            'periode'                => ['bail', 'string', 'max:20'],
            'pegawai_id'             => ['bail', 'required', 'string', 'max:36'],
            'kehadiran'              => ['bail', 'required', 'string'],
            'absen'                  => ['bail', 'string'],
            'cuti'                   => ['bail', 'required', 'string'],
            'alpha'                  => ['bail', 'required', 'string'],
            'gaji_pokok'             => ['bail', 'required', 'string'],
            'jumlah_tunjangan_tetap' => ['bail', 'required', 'string'],
            'jumlah_insentif'        => ['bail', 'required', 'string'],
            'jumlah_lembur'          => ['bail', 'required', 'string'],
            'jumlah_potongan_nwnp'   => ['bail', 'string'],
            'jumlah_potongan_bpjs'   => ['bail', 'string'],
        ];
    }
}
