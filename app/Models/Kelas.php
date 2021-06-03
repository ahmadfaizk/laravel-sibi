<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'm_kelas';

    protected $fillable = [
        'nama',
        'tingkat',
        'id_tahun_ajaran',
    ];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('H:i, d M Y');
    }

    public function mapel()
    {
        return $this->belongsToMany(MataPelajaran::class, 'kelas_mapel', 'id_kelas', 'id_mapel');
    }

    public function siswa()
    {
        return $this->belongsToMany(Siswa::class, 'siswa_kelas', 'id_kelas', 'id_siswa');
    }
}
