<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jam extends Model
{
    use HasFactory;

    protected $table = 'r_jam';
    protected $fillable = ['jam'];

    // get all jam
    public static function getAll()
    {
        return self::all();
    }

    // jam mulai
    public function dokterJadwalMulai()
    {
        return $this->hasMany(DokterJadwal::class, 'jam_mulai_id');
    }

    // jam selesai
    public function dokterJadwalSelesai()
    {
        return $this->hasMany(DokterJadwal::class, 'jam_selesai_id');
    }
}
