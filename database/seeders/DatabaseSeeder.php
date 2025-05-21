<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Author;
use App\Models\Category;
use App\Models\Rating;
use App\Models\Book;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AuthorSeeder::class,
            CategorySeeder::class,
            RatingSeeder::class,
            BookSeeder::class,
        ]);
    }
}

// AuthorSeeder.php
class AuthorSeeder extends Seeder
{
    public function run(): void
    {
        $authors = [];
        for ($i = 0; $i < 1000; $i++) {
            $authors[] = [
                'name' => fake()->name(),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        Author::insert($authors);
    }
}

// CategorySeeder.php
class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [];
        for ($i = 0; $i < 3000; $i++) {
            $categories[] = [
                'name' => fake()->word(),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        Category::insert($categories);
    }
}

// RatingSeeder.php
class RatingSeeder extends Seeder
{
    public function run(): void
    {
        $ratings = [];
        for ($i = 0; $i < 500000; $i++) {
            $ratings[] = [
                'average_rating' => fake()->randomFloat(1, 1, 10),
                'voter' => fake()->numberBetween(1, 1000),
                'created_at' => now(),
                'updated_at' => now(),
            ];
            if (count($ratings) >= 1000) {
                Rating::insert($ratings);
                $ratings = [];
            }
        }
        if (!empty($ratings)) {
            Rating::insert($ratings);
        }
    }
}

// BookSeeder.php
class BookSeeder extends Seeder
{
    public function run(): void
    {
        $books = [];
        for ($i = 0; $i < 100000; $i++) {
            $books[] = [
                'title' => fake()->sentence(3),
                'author_id' => rand(1, 1000),
                'category_id' => rand(1, 3000),
                'rating_id' => rand(1, 500000),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            if (count($books) >= 1000) {
                Book::insert($books);
                $books = [];
            }
        }

        if (!empty($books)) {
            Book::insert($books);
        }
    }
}
