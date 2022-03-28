<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class BudgetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id' => function () {
                return Category::factory()->create()->id;
            },
            'user_id' => function () {
                return User::factory()->create()->id;
            },
            'amount' => $this->faker->randomFloat(2, 500, 1000),
            'budget_date' => Carbon::now()->format('M'),
        ];
    }
}