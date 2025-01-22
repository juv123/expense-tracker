<?php

namespace Database\Factories;

use App\Models\Expense;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExpenseFactory extends Factory
{
    protected $model = Expense::class;
  
    public function definition()
    {
        return [
            'user_id' =>  Auth::user()->id, 
            'category_id' => \App\Models\Category::factory(), 
            'amount' => $this->faker->randomFloat(2, 10, 1000),
            'description' => $this->faker->sentence(),
            'date' => $this->faker->date(),
        ];
    }
}
