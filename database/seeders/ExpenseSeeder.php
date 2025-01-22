<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Expense;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;


class ExpenseSeeder extends Seeder
{
    
    public function run(): void
    {
        if (auth()->check()) {
            $userId = auth()->id(); // Get the logged-in user's ID

        } else {
            // No user is logged in
            $userId = 1;
        }
        $categories = Category::all(); // Retrieve existing categories
              // Create expenses and randomly assign categories
        foreach ($categories as $category) {
            Expense::create([
                 'user_id' => $userId, // Replace with the appropriate user ID
                'category_id' => $category->id,
                'amount' => rand(50, 500), // Random amount
                'description' => ' expense for ' .$category->description,
                'date_of_expense' => now(),
            ]);
        }
    }
}
