<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    use HasFactory;

    protected $table = 'm_tahun_ajaran';

    protected $fillable = [
        'nama',
        'tahun_awal',
        'tahun_akhir',
    ];
}
