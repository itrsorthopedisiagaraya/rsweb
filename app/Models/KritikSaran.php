<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KritikSaran extends Model
{
    use HasFactory;
    protected $table = 'm_kritik_saran';
    protected $fillable = [
        'nama',
        'email',
        'no_telepon',
        'rating',
        'kritik_saran',
        'gambar',
    ];
    protected $casts = [
        'gambar' => 'array',
    ];
}
