<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RatingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'rating'        => rand(1, 4),
            'review'        => $this->faker->text($maxNbChars = 200),
            'created_at'    => date('now'),
            'updated_at'    => date('now')
        ];
    }
}
