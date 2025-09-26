<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Expense;
use App\Models\User;
use App\Models\Category;

class ExpenseSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        $categories = Category::pluck('id', 'name');
        $expenses = [
            [
                'amount' => 50.25,
                'description' => 'Weekly groceries',
                'category_id' => $categories['Groceries'] ?? 1,
                'date' => now()->subDays(2)->toDateString(),
            ],
            [
                'amount' => 120.00,
                'description' => 'Concert ticket',
                'category_id' => $categories['Leisure'] ?? 2,
                'date' => now()->subDays(10)->toDateString(),
            ],
            [
                'amount' => 300.00,
                'description' => 'New headphones',
                'category_id' => $categories['Electronics'] ?? 3,
                'date' => now()->subDays(20)->toDateString(),
            ],
            [
                'amount' => 75.00,
                'description' => 'Electricity bill',
                'category_id' => $categories['Utilities'] ?? 4,
                'date' => now()->subDays(5)->toDateString(),
            ],
            [
                'amount' => 40.00,
                'description' => 'T-shirt',
                'category_id' => $categories['Clothing'] ?? 5,
                'date' => now()->subDays(15)->toDateString(),
            ],
            [
                'amount' => 60.00,
                'description' => 'Pharmacy',
                'category_id' => $categories['Health'] ?? 6,
                'date' => now()->subDays(7)->toDateString(),
            ],
            [
                'amount' => 20.00,
                'description' => 'Miscellaneous',
                'category_id' => $categories['Others'] ?? 7,
                'date' => now()->subDays(1)->toDateString(),
            ],
        ];
        foreach ($expenses as $expense) {
            Expense::create(array_merge($expense, ['user_id' => $user->id]));
        }
    }
}
