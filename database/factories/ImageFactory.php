<?php

namespace Database\Factories;

use App\Enums\ImageRole;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $width = fake()->randomElement([800, 1200, 1920]);
        $height = fake()->randomElement([600, 800, 1080]);

        return [
            'user_id' => User::factory(),
            'path' => "https://picsum.photos/{$width}/{$height}?random=" . fake()->uuid(),
            'disk' => 'local',
            'mime_type' => 'image/jpeg',
            'size' => fake()->numberBetween(100000, 5000000),
            'width' => $width,
            'height' => $height,
            'role' => ImageRole::GALLERY,
        ];
    }
    public function main(): static
    {
        return $this->state(fn(array $attributes) => [
            'role' => ImageRole::MAIN,
        ]);
    }
}
