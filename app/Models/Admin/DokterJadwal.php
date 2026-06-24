<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokterJadwal extends Model
{
    use HasFactory;

    protected $table = 'm_jadwal_dokter';
    protected $fillable = [
        'dokter_id',
        'hari_id',
        'jam_mulai_id',
        'jam_selesai_id',
    ];

    // join to dokter
    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'dokter_id');
    }

    // join to hari (one to many)
    public function hari()
    {
        return $this->belongsTo(Hari::class, 'hari_id');
    }

    // join to jam
    public function jamMulai()
    {
        return $this->belongsTo(Jam::class, 'jam_mulai_id');
    }

    // join to jam selesai
    public function jamSelesai()
    {
        return $this->belongsTo(Jam::class, 'jam_selesai_id');
    }

    // get jadwal by id
    public static function getJadwalById($id)
    {
        return DokterJadwal::find($id);
    }

    // get all data
    public static function getAll()
    {
        return DokterJadwal::orderBy('id', 'desc')->get();
    }

    // get jadwal hari by id
    public static function getJadwalHariById($id)
    {
        return DokterJadwal::where('dokter_id', $id)->get();
    }

    public static function getJadwalByHari($hari_id)
    {
        return DokterJadwal::where('hari_id', $hari_id)->get();
    }
}
