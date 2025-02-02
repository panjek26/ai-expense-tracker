<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncomeCategory extends Model
{
    protected $fillable = ['name', 'slug'];

    public function incomes()
    {
        return $this->hasMany(Income::class);
    }
}