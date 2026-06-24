<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerAsuransi extends Model
{
    use HasFactory;

    protected $table = 'm_partner';
    protected $fillable = [
        'nama_partner',
        'logo_partner',
        'link_partner',
        'deskripsi_partner',
    ];
}
