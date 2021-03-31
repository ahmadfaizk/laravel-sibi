<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class TahunAjaran extends Model
{
    use HasFactory;

    protected $table = 'm_tahun_ajaran';

    protected $fillable = [
        'tahun_awal',
        'tahun_akhir',
    ];

    public function getNamaAttribute() {
        return $this->tahun_awal . '/' . $this->tahun_akhir;
    }

    public function getCreatedAtAttribute($value) {
        return Carbon::parse($value)->format('H:i, d M Y');
    }
}
