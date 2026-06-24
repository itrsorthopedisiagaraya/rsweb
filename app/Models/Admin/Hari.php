<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hari extends Model
{
    use HasFactory;

    protected $table = 'r_hari';
    protected $fillable = ['hari'];

    // get all hari
    public static function getAll()
    {
        return self::all();
    }

    public function jadwalDokter()
    {
        return $this->hasMany(DokterJadwal::class,'hari_id','id');
    }
}
