<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Place>
 */
class PlaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->city(),
            'is_favourite' => $this->faker->numberBetween(0,1),
            'description' =>  $this->faker->sentence(),
            'image' =>  $this->faker->imageUrl(640, 480),
            'latitude' =>  $this->faker->latitude,
            'longitude' =>  $this->faker->longitude,
            'address' =>  $this->faker->address(),
            'distance' =>  $this->faker->randomFloat(2, 0, 300).' km',
            'by_car' =>  $this->faker->numberBetween(0, 20).' hr 10',
            'by_public_transport' => $this->faker->numberBetween(0, 20).' hr 10',
        ];
    }
}
