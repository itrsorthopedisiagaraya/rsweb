<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postingan extends Model
{
    use HasFactory;

    protected $table = 'm_postingan';
    protected $fillable = [
        'judul',
        'slug',
        'konten',
        'gambar',
        'status',
        'created_by',
        'updated_by',
    ];

    // get all data
    public static function getAll()
    {
        return self::orderBy('id', 'desc')->get();
    }

    // get by id
    public static function getById($id)
    {
        return self::find($id);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
    }
}
