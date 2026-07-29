<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departemen extends Model
{
    use HasFactory;

    protected $table = 'departemen';

    protected $guarded = [];

    public function posisi()
    {
        return $this->hasMany(Posisi::class, 'departemen_id');
    }

    public function pegawai()
    {
        return $this->hasMany(Pegawai::class, 'departemen_id');
    }
}
