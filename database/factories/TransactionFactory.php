<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'description' => $this->faker->sentence(2),
            'category_id' => function () {
                return Category::factory()->create()->id;
            },
            'amount' => $this->faker->numberBetween(5, 10),
            'user_id' => function () {
                return User::factory()->create()->id;
            },
        ];
    }
}