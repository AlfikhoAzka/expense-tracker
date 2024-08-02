<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
    ];

    public function scopeFilter (Builder $query): void
    {
        $query->where('name', 'like', '%' . request('search') . '%');
    }
}
