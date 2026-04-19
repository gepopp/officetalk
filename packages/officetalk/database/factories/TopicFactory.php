<?php

declare(strict_types=1);

namespace Officetalk\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Officetalk\Models\Topic;

class TopicFactory extends Factory
{
    protected $model = Topic::class;

    public function definition(): array
    {
        $slug = fake()->unique()->randomElement(config('officetalk.topics', ['esg', 'wohnbau', 'proptech']));

        return [
            'slug' => $slug,
            'name' => str($slug)->replace('-', ' ')->title(),
            'description' => fake()->sentence(12),
        ];
    }
}
