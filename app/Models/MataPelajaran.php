<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    use HasFactory;

    protected $table = 'm_mata_pelajaran';

    protected $fillable = [
        'nama',
        'id_kategori_mapel',
    ];

    public function kategori() {
        return $this->belongsTo(KategoriMapel::class, 'id_kategori_mapel');
    }
}
