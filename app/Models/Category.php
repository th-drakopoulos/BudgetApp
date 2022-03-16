<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug', 'user_id'];
    public static function boot()
    {
        parent::boot();
        static::addGlobalScope('user', function ($query) {
            $query->where('user_id', auth()->id());
        });

        static::saving(function ($category) {
            $category->user_id = $category->user_id ?: auth()->id();
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}