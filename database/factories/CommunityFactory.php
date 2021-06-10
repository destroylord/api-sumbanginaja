<?php

namespace Database\Factories;

use App\Models\Community;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommunityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Community::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'images' => $this->faker->imageUrl($width = 640, $height = 480),
            'locations' => $this->faker->address,
            'descriptions' => $this->faker->text($maxNbChars = 200) ,
        ];
    }
}
