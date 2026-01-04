<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RPS extends Model
{
    protected $table = 'rps';

    protected $fillable = [
        'mata_kuliah_id',
        'tahun_ajaran',
        'semester',
        'dosen_pengampu',
        'capaian_pembelajaran',
        'prasyarat',
        'referensi',
        'metode_pembelajaran',
        'metode_penilaian',
        'qr_code_path',
        'qr_code_hash',
        'status'
    ];

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'mata_kuliah_id');
    }

    public function pertemuan()
    {
        return $this->hasMany(RpsPertemuan::class, 'rps_id');
    }
}
