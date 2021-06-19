<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Event::class;

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
            'community_id'  => rand(1,4),
            'locations'     => $this->faker->address,
            'descriptions'  => $this->faker->text($maxNbChars = 200) ,
        ];
    }
}
