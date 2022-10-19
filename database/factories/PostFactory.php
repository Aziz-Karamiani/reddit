<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "community_id" => rand(1, 100),
            "user_id" => rand(1, 100),
            "title" => fake()->title(),
            "post_text" => fake()->text(100),
            "post_url" => fake()->url,
        ];
    }
}
