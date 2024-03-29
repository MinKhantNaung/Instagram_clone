<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
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
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'description' => fake()->sentence(),
            'location' => fake()->city(),
            'hide_like_view' => fake()->boolean(),
            'allow_commenting' => fake()->boolean(),
            'type' => 'post',
        ];
    }

    public function configure() : static
    {
        return $this->afterCreating(function (Post $post) {
            if ($post->type == 'reel') {
                // Media::factory()->reel()->create(['mediable_type' => get_class($post), 'mediable_id' => $post->id]);
            } else {
                // Media::factory()->post()->create(['mediable_type' => get_class($post), 'mediable_id' => $post->id]);
            }
        });
    }
}
