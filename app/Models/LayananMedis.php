<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LayananMedis extends Model
{
    use HasFactory;

    protected $table = 'm_layanan_medis';
    protected $guarded = ['id'];
}
