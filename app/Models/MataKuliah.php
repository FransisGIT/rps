<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    protected $table = 'mata_kuliah';

    protected $fillable = [
        'kode_mk',
        'nama_mk',
        'sks',
        'semester',
        'prodi',
        'deskripsi'
    ];

    public function rps()
    {
        return $this->hasMany(RPS::class, 'mata_kuliah_id');
    }
}
