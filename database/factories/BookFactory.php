<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Author;
use App\Models\Category;
use App\Models\Rating;

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
    public function definition(): array
    {
       return [
        'title' => $this->faker->sentence(3),
        'author_id' => Author::inRandomOrder()->first()->id ?? Author::factory(),
        'category_id' => Category::inRandomOrder()->first()->id ?? Category::factory(),
        'rating_id' => Rating::inRandomOrder()->first()->id ?? Rating::factory(),
        ];
    }
}
