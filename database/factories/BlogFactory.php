<?php

namespace Database\Factories;

use App\MOdels\User;
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

     public function definition(): array
    {
        return [
           'title' => $this->faker->sentence,
           'content' => $this->faker->paragraph,
            'user_id' => User::factory(), // User モデルのファクトリを使用してユーザーIDを生成
        ];
    }

    // public function definition()
    // {
    //     return [
    //         'title' => $this->faker->word,
    //         'content' => $this->faker->realText,
    //         'user_id' => $this->faker->int,
    //     ];
    // }
    // $factory->define(Blog::class, function (Faker $faker) {
    //     return [
    //                 'title' => $faker
    //                 'content' => $faker
    //             ];
    // });
}