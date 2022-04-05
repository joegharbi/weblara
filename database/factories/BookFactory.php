<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title'=>$this->faker->word(),
            'authors'=>$this->faker->name(),
            'description'=>$this->faker->sentence(),
            'released_at'=>$this->faker->date(),
            'cover_image'=>$this->faker->imageUrl(),
            'pages'=>$this->faker->numberBetween(90,750),
            'language_code'=>$this->faker->bothify('???'),
            'isbn'=>$this->faker->sentence(),
            'in_stock'=>$this->faker->randomNumber(),

        ];
    }
}
