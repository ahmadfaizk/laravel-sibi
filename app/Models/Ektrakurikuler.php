<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ektrakurikuler extends Model
{
    use HasFactory;

    protected $table = 'm_ekstrakurikuler';

    protected $fillable = [
        'nama',
    ];
}
