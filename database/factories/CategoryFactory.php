<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->word();
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'user_id' => function () {
                return User::factory()->create()->id;
            },
        ];
    }
}