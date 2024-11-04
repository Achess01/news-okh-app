<?php

namespace Database\Factories;

use App\Enums\PostStatus;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PostReport>
 */
class PostReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $posts_reported = Post::where('status', PostStatus::reportedReview);
        $post = $posts_reported->count() > 0 ? $posts_reported->inRandomOrder()->first() : Post::all()->random()->id;
        return [
            'post_id' => $post->id,
            'user_id' => User::all()->random()->id,
            'reported_reason' => $this->faker->realText(),
            'reported_at' => now(),
        ];
    }
}
