<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawai';

    protected $guarded = [];

    public function departemen()
    {
        return $this->belongsTo(Departemen::class, 'departemen_id');
    }

    public function posisi()
    {
        return $this->belongsTo(Posisi::class, 'posisi_id');
    }

    public function getAllPegawaiLengkap(string $id)
    {
        return Pegawai::with('departemen', 'posisi')->find($id);
    }
}
