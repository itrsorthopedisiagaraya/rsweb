<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    public $table = 'm_kategori';

    protected $fillable = [
        'terkait',
        'kategori',
    ];

    // get all data
    public static function getAll($ref)
    {
        return self::where('terkait', $ref)->orderBy('id', 'desc')->get();
    }

    // join to karir
    public function karir()
    {
        return $this->hasMany(Karir::class, 'kategori_id', 'id');
    }
}
