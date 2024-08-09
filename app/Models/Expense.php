<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Expense extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
    ];

    public function scopeSearch($query, $search)
    {
        if (!$search) {
            return $query;
        }

        return $query->where(function ($query) use ($search) {
            $query
                ->where('name', 'LIKE', "%$search%");
        });
    }

    public function PriceFormatted(): Attribute
    {
        return new Attribute(
            get: fn ($value) => 'Rp ' . number_format($value, 3, ',', '.'),
        );
    }
}