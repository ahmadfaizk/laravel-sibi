<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiMapel extends Model
{
    use HasFactory;

    protected $table = 't_nilai_mapel';

    protected $fillable = [
        'id_tahun_ajaran',
        'id_kelas',
        'id_semester',
        'id_mapel',
        'id_siswa',
        'nilai_pengetahuan',
        'nilai_ketrampilan',
    ];
}
