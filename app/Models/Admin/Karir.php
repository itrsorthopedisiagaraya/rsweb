<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karir extends Model
{
    use HasFactory;
    protected $table = 'h_karir';
    protected $fillable = [
        'kategori_id',
        'pendidikan',
        'pengalaman',
        'bidang_pengalaman',
        'kriteria',
        'jobdesk',
        'informasi',
    ];

    // join to kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
    }
}
