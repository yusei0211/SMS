<?php

namespace Database\Seeders;
use App\Models\Blog;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Blog::factory(10)->create();
        // \Database\Factories\BlogFactory::new()->count(15)->create();
    }
}