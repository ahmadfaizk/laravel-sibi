<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiEkstrakurikuler extends Model
{
    use HasFactory;

    protected $table = 't_nilai_ekstrakurikuler';

    public $timestamps = false;

    protected $fillable = [
        'id_tahun_ajaran',
        'id_kelas',
        'id_semester',
        'id_ekstrakurikuler',
        'id_siswa',
        'predikat',
    ];
}
