<?php

namespace Database\Seeders;

use App\Models\IncomeCategory;
use Illuminate\Database\Seeder;

class IncomeCategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Salary', 'description' => 'Regular employment income'],
            ['name' => 'Investment', 'description' => 'Returns from investments'],
            ['name' => 'Freelance', 'description' => 'Freelance work income'],
            ['name' => 'Business', 'description' => 'Business revenue'],
            ['name' => 'Rental', 'description' => 'Income from property rentals'],
            ['name' => 'Dividend', 'description' => 'Dividend payments'],
            ['name' => 'Gift', 'description' => 'Gifts received'],
            ['name' => 'Other', 'description' => 'Other income sources']
        ];

        foreach ($categories as $category) {
            IncomeCategory::create($category);
        }
    }
}