<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpenseCategory extends Model
{
    protected $fillable = ['name', 'slug'];

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
}