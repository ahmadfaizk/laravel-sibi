<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriMapel extends Model
{
    use HasFactory;

    protected $table = 'm_kategori_mapel';

    protected $fillable = [
        'nama',
    ];
}
