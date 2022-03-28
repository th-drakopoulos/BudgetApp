<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

    public $fillable = ['category_id', 'amount', 'budget_date'];

    public static function boot()
    {
        parent::boot();
        static::addGlobalScope('user', function ($query) {
            $query->where('user_id', auth()->id());
        });

        static::saving(function ($budget) {
            $budget->user_id = $budget->user_id ?: auth()->id();
            $budget->budget_date = Carbon::parse($budget->budget_date)->toDateTimeString();
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function balance()
    {
        return $this->amount - $this->category->transactions->sum('amount');
    }

    public function getMonth()
    {
        return isset($this->budget_date) ? Carbon::parse($this->budget_date)->format('M') : null;
    }

    public function scopeByMonth($quest, $month = 'this month')
    {
        $quest->where('budget_date', '>=', Carbon::parse("first day of {$month}"))
            ->where('budget_date', '<=', Carbon::parse("last day of {$month}"));
    }
}