<?php

namespace App\Models;

use App\Models\Admin\Dokter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokterDetail extends Model
{
    use HasFactory;
    protected $table = 'r_dokter_detail';
    protected $guarded = ['id'];

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'id', 'dokter_id');
    }
}
