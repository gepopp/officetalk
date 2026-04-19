<?php

declare(strict_types=1);

namespace Officetalk\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Officetalk\Models\Episode;
use Officetalk\Models\Guest;

class EpisodeFactory extends Factory
{
    protected $model = Episode::class;

    public function definition(): array
    {
        $number = fake()->unique()->numberBetween(1, 999);
        $paddedNumber = str_pad((string) $number, 3, '0', STR_PAD_LEFT);

        return [
            'number' => $number,
            'slug' => 'ep-'.$paddedNumber.'-'.fake()->unique()->slug(3),
            'title' => fake()->sentence(6),
            'eyebrow' => null,
            'abstract' => fake()->paragraph(3),
            'lead_quote' => fake()->sentence(10),
            'guest_id' => Guest::factory(),
            'vimeo_id' => (string) fake()->numberBetween(100_000_000, 999_999_999),
            'linkedin_url' => 'https://www.linkedin.com/feed/update/urn:li:activity:'.fake()->numberBetween(7_000_000_000_000_000_000, 7_999_999_999_999_999_999),
            'spotify_url' => null,
            'transcript_markdown' => null,
            'still_landscape' => "officetalk/stills/ep-{$paddedNumber}-landscape.webp",
            'still_square' => "officetalk/stills/ep-{$paddedNumber}-square.webp",
            'thumbnail_linkedin' => "officetalk/thumbnails/ep-{$paddedNumber}-linkedin.webp",
            'duration_minutes' => fake()->numberBetween(18, 42),
            'published_at' => now()->subDays(fake()->numberBetween(0, 180)),
            'is_featured' => false,
            'meta_title' => null,
            'meta_description' => null,
        ];
    }

    public function featured(): static
    {
        return $this->state(fn () => ['is_featured' => true]);
    }

    public function draft(): static
    {
        return $this->state(fn () => ['published_at' => null]);
    }

    public function scheduled(): static
    {
        return $this->state(fn () => ['published_at' => now()->addDays(7)]);
    }
}
