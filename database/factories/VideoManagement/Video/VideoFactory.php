<?php

namespace Database\Factories\VideoManagement\Video;

use App\Domains\VideoManagement\Enums\VideoRatingEnum;
use App\Models\VideoManagement\Category\Category;
use App\Models\VideoManagement\Genre\Genre;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VideoManagement\Video\Video>
 */
class VideoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->title(),
            'description' => fake()->sentence(),
            'duration' => 143,
            'release_date' => now()->subYear(2),
            'rating' => VideoRatingEnum::L,
            'is_published' => false,
            'category_id' => Category::factory(),
            'genre_id' => Genre::factory(),
        ];
    }
}
