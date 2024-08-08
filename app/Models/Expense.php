<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function Pest\Laravel\get;

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

    protected function getPriceAttribute($value)
    {
        return 'Rp.' . number_format($value, 3, '.', ',');
    }
}