<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = ['description', 'category_id', 'amount', 'user_id'];

    public static function boot()
    {
        parent::boot();
        static::addGlobalScope('user', function ($query) {
            $query->where('user_id', auth()->id());
        });

        static::saving(function ($transaction) {
            $transaction->user_id = $transaction->user_id ?: auth()->id();
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeByCategory($query, Category $category)
    {
        if ($category->exists) {
            $query->where('category_id', $category->id);
        }
    }
}