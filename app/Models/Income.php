<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'income_category_id',
        'amount',
        'transaction_date',
        'description',
        'category',
        'notes'
    ];

    protected $casts = [
        'transaction_date' => 'date',
        'amount' => 'decimal:2'
    ];
}