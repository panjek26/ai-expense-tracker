<?php

namespace App\Services;

use OpenAI\Laravel\Facades\OpenAI;

class FinancialAnalysisService
{
    public function getFinancialRecommendations($income, $expenses, $budgets, $categoryExpenses)
    {
        $prompt = $this->buildAnalysisPrompt($income, $expenses, $budgets, $categoryExpenses);
        
        $result = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'You are a financial advisor AI. Provide concise, practical advice based on the user\'s financial data.'
                ],
                [
                    'role' => 'user',
                    'content' => $prompt
                ]
            ]
        ]);

        return $result->choices[0]->message->content;
    }

    private function buildAnalysisPrompt($income, $expenses, $budgets, $categoryExpenses)
    {
        $savingsRate = $income > 0 ? (($income - $expenses) / $income) * 100 : 0;
        
        return "Analyze this financial data and provide specific recommendations:
                - Monthly Income: Rp " . number_format($income, 0, ',', '.') . "
                - Monthly Expenses: Rp " . number_format($expenses, 0, ',', '.') . "
                - Savings Rate: {$savingsRate}%
                - Category Expenses: " . json_encode($categoryExpenses) . "
                - Category Budgets: " . json_encode($budgets) . "
                
                Please provide:
                1. Brief analysis of spending patterns
                2. 2-3 specific recommendations for improvement
                3. Savings and budget optimization advice";
    }

    public function getFinancialAnalysis($income, $expenses, $budgets, $categoryExpenses, $expensesByCategory)
        {
            $prompt = "As a financial advisor, analyze this data and provide specific insights:
                      Monthly Income: Rp " . number_format($income, 0, ',', '.') . "
                      Monthly Expenses: Rp " . number_format($expenses, 0, ',', '.') . "
                      
                      Expense Categories:
                      " . json_encode($expensesByCategory) . "
                      
                      Current Budgets:
                      " . json_encode($budgets) . "
                      
                      Please provide:
                      1. Spending patterns analysis
                      2. Budget utilization insights
                      3. Savings potential
                      4. Specific recommendations for improvement
                      
                      Format the response in clear, concise paragraphs.";
    
            $result = OpenAI::chat()->create([
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'You are a professional financial advisor. Provide clear, actionable insights based on the financial data.'
                    ],
                    [
                        'role' => 'user',
                        'content' => $prompt
                    ]
                ]
            ]);
    
            return $result->choices[0]->message->content;
        }
}