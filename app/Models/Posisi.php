<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posisi extends Model
{
    use HasFactory;

    protected $table = 'posisi';

    protected $guarded = [];

    public function departemen()
    {
        return $this->belongsTo(Departemen::class, 'departemen_id');
    }

    public function pegawai()
    {
        return $this->hasMany(Pegawai::class, 'posisi_id');
    }
}
