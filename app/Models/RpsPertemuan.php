<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RpsPertemuan extends Model
{
    protected $table = 'rps_pertemuan';

    protected $fillable = [
        'rps_id',
        'pertemuan_ke',
        'materi',
        'metode',
        'waktu'
    ];

    public function rps()
    {
        return $this->belongsTo(RPS::class, 'rps_id');
    }
}
