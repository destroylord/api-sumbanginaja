<?php

namespace Database\Factories;

use App\Models\Food;
use Illuminate\Database\Eloquent\Factories\Factory;

class FoodFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Food::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'          => $this->faker->name,
            'images'        => $this->faker->imageUrl($width = 640, $height = 480),
            'user_id'       => rand(1,4),
            'descriptions'  => $this->faker->text($maxNbChars = 200) ,
            'payback_time'  => $this->faker->time($format = 'H:i:s', $max = 'now')
        ];
    }
}
