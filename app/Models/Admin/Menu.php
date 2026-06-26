<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $table = 'm_menu';
    protected $fillable = [
        'title',
        'slug',
        'icon',
        'route',
        'url',
        'parent_id',
        'sort_order',
        'permission',
        'is_active'
    ];

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id')
            ->orderBy('sort_order');
    }

    public function childrenRecursive()
    {
        return $this->children()
            ->with('childrenRecursive');
    }

    public function childrenRecursiveFiltered()
    {
        return $this->children()
            ->with('childrenRecursiveFiltered');
    }

    public function users()
    {
        return $this->belongsToMany(
            \App\Models\User::class,
            'user_menu'
        );
    }
}
