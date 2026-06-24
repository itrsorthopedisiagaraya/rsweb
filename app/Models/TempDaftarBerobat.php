<?php

namespace App\Models;

use App\Models\Admin\Dokter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempDaftarBerobat extends Model
{
    use HasFactory;

    protected $table = 'temp_daftar_berobat';
    protected $guarded = ['id'];

    public function dokter()
    {
        return $this->hasOne(Dokter::class, 'id', 'dokter_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
