<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PostVote>
 */
class PostVoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $votes = [-1, 1];
        return [
            'user_id' => rand(1, 100),
            'post_id' => rand(1, 100),
            'vote' => $votes[rand(0,1)]
        ];
    }
}
