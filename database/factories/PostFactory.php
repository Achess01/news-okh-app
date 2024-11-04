<?php

namespace Database\Factories;

use App\Enums\PostStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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

        $title = $this->faker->sentence();
        $p = $this->faker->paragraph();
        $p2 = $this->faker->paragraph();
        $imageUrl = 'https://www.fcbarcelona.com/photo-resources/2020/03/29/fb93f75f-ece8-408c-85c8-a3ee0f045291/27-05-09-MESSI-ALEGRIA-02.jpg?width=500';

        $content = "
        <h1>$title</h1>
<p>$p</p>
<p>$p</p>
<p>$p2</p>
<img src=\"$imageUrl\" alt=\"Lionel Messi celebrando un gol\" class=\"img-fluid mt-3\" width=\"300\" height=\"300\" />";
        return [
            'user_id' => User::all()->random()->id,
            'title' => $this->faker->sentence(),
            'place' => $this->faker->address(),
            'event_date' => $this->faker->dateTime(),
            'body' => $content,
            'status' => PostStatus::cases()[array_rand(PostStatus::cases())]
        ];
    }
}
