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
    ];

    public function getCreatedAtAttribute($value) {
        return Carbon::parse($value)->format('H:i, d M Y');
    }
}
