<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Support\Str;
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
    protected $model = Post::class;

    public function definition(): array
    {
        $title = $this->faker->sentence(6);

        return [
            'title'   => $title,
            'content' => $this->faker->paragraphs(4, true),
            'slug'    => Str::slug($title) . '-' . $this->faker->unique()->numberBetween(100, 999),
            'excerpt' => $this->faker->optional()->sentence(12),
        ];
    }
}
