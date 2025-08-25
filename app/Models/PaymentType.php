<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    protected $fillable = ['payment_type'];

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
}

