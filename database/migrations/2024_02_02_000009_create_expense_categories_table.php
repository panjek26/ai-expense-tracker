<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::create('expense_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->timestamps();
        });

        // Insert default expense categories
        DB::table('expense_categories')->insert([
            ['name' => 'Housing', 'slug' => 'housing'],
            ['name' => 'Transportation', 'slug' => 'transportation'],
            ['name' => 'Food & Dining', 'slug' => 'food'],
            ['name' => 'Utilities', 'slug' => 'utilities'],
            ['name' => 'Healthcare', 'slug' => 'healthcare'],
            ['name' => 'Entertainment', 'slug' => 'entertainment'],
            ['name' => 'Shopping', 'slug' => 'shopping'],
            ['name' => 'Education', 'slug' => 'education'],
            ['name' => 'Personal Care', 'slug' => 'personal-care'],
            ['name' => 'Insurance', 'slug' => 'insurance'],
            ['name' => 'Debt Payments', 'slug' => 'debt'],
            ['name' => 'Savings', 'slug' => 'savings'],
            ['name' => 'Other', 'slug' => 'other']
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('expense_categories');
    }
};