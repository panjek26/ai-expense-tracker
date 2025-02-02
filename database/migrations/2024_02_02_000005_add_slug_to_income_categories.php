<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Only insert default categories
        DB::table('income_categories')->insert([
            ['name' => 'Salary', 'slug' => 'salary'],
            ['name' => 'Investment Returns', 'slug' => 'investment'],
            ['name' => 'Freelance Work', 'slug' => 'freelance'],
            ['name' => 'Business Income', 'slug' => 'business'],
            ['name' => 'Rental Income', 'slug' => 'rental'],
            ['name' => 'Dividends', 'slug' => 'dividend'],
            ['name' => 'Gifts Received', 'slug' => 'gift'],
            ['name' => 'Other Income', 'slug' => 'other']
        ]);
    }

    public function down()
    {
        DB::table('income_categories')->truncate();
    }
};