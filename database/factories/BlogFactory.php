<?php

namespace Database\Factories;

use App\MOdels\Blog;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word,
            'content' => $this->faker->realText,

        ];
    }
    // $factory->define(Blog::class, function (Faker $faker) {
    //     return [
    //                 'title' => $faker
    //                 'content' => $faker
    //             ];
    // });
}