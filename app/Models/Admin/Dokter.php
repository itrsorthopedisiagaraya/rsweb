<?php

namespace App\Models\Admin;

use App\Models\DokterDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Dokter extends Model
{
    use HasFactory;

    protected $table = 'm_dokter';
    protected $fillable = [
        'nama_dokter',
        'spesialis',
        'alamat',
        'no_telp',
        'email',
        'password',
        'foto',
        'status',
    ];

    // join to dokter jadwal
    public function dokterJadwal()
    {
        return $this->hasMany(DokterJadwal::class, 'dokter_id');
    }

    public function dokterDetail()
    {
        return $this->hasMany(DokterDetail::class, 'dokter_id', 'id');
    }

    // join dokter_jadwal & hari
    public function hari()
    {
        return $this->hasManyThrough(
            Hari::class,
            DokterJadwal::class,
            'dokter_id',
            'id',
            'id',
            'hari_id'
        );
    }

    // join dokter_jadwal & jam_mulai
    public function jamMulai()
    {
        return $this->hasManyThrough(
            Jam::class,
            DokterJadwal::class,
            'dokter_id',
            'id',
            'id',
            'jam_mulai_id'
        );
    }

    // join dokter_jadwal & jam_selesai
    public function jamSelesai()
    {
        return $this->hasManyThrough(
            Jam::class,
            DokterJadwal::class,
            'dokter_id',
            'id',
            'id',
            'jam_selesai_id'
        );
    }

    // get all data
    public static function getAll()
    {
        return Dokter::orderBy('id', 'desc')->get();
    }

    // get all data with jadwal
    public static function getFilterWithJadwal($hari)
    {
        return Dokter::with(['hari','jamMulai','jamSelesai'])
                    ->whereHas('hari', function ($query) use ($hari) {
                        $query->where('hari', $hari);
                    })->get();
    }
    
    public static function getAllWithJadwal()
    {
        return Dokter::with(['hari','jamMulai','jamSelesai'])->get();
    }

    // get all data with jadwal by id
    public static function getAllWithJadwalById($id)
    {
        return Dokter::with(['dokterJadwal','jamMulai','jamSelesai','hari'])->where('id', $id)->first();
    }

    // get data by id
    public static function getById($id)
    {
        return Dokter::where('id', $id)->first();
    }
}
