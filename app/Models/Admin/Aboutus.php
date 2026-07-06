<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aboutus extends Model
{
    use HasFactory;

    protected $table = 'm_aboutus';
    protected $fillable = [
        'judul',
        'slug',
        'konten',
        'gambar',
        'created_by',
        'updated_by',
        'disabled',
    ];

    protected $casts = [
        'disabled' => 'boolean',
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

    // scope to filter enabled records
    public function scopeEnabled($query)
    {
        return $query->where('disabled', false);
    }

}
