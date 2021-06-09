<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ketidakhadiran extends Model
{
    use HasFactory;

    protected $table = 't_ketidakhadiran';
    public $timestamps = false;

    protected $fillable = [
        'id_tahun_ajaran',
        'id_kelas',
        'id_semester',
        'id_siswa',
        'sakit',
        'izin',
        'tanpa_keterangan'
    ];
}
