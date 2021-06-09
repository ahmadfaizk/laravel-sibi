<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    use HasFactory;

    protected $table = 't_prestasi';
    public $timestamps = false;

    protected $fillable = [
        'id_tahun_ajaran',
        'id_kelas',
        'id_semester',
        'id_siswa',
        'kegiatan',
        'keterangan',
    ];
}
