<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'm_siswa';

    protected $fillable = [
        'nama_lengkap',
        'nomor_nis',
        'nomor_nisn',
        'jenis_kelamin',
        'agama',
        'alamat_peserta_didik',
        'tempat_lahir',
        'tgl_lahir',
        'pendidikan_sebelumnya',
        'nama_ayah',
        'nama_ibu',
        'nama_wali',
        'pekerjaan_ayah',
        'pekerjaan_ibu',
        'alamat_orangtua',
        'alamat_wali',
        'foto_masuk',
        'foto_keluar',
        'masuk_tingkat',
        'status',
        'id_kelas',
        'id_ta_masuk',
    ];

    public function kelas()
    {
        return $this->belongsToMany(Kelas::class, 'siswa_kelas', 'id_siswa', 'id_kelas');
    }
}
