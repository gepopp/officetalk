<?php

declare(strict_types=1);

namespace Officetalk\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Officetalk\Models\Guest;

class GuestFactory extends Factory
{
    protected $model = Guest::class;

    public function definition(): array
    {
        $firstName = fake()->firstName();
        $lastName = fake()->lastName();

        return [
            'slug' => str($lastName.'-'.$firstName)->slug(),
            'first_name' => $firstName,
            'last_name' => $lastName,
            'role' => fake()->randomElement(['CEO', 'Head of Marketing', 'Managing Partner', 'CFO', 'Geschäftsführer']),
            'company' => fake()->company(),
            'company_url' => fake()->url(),
            'linkedin_url' => 'https://linkedin.com/in/'.fake()->userName(),
            'portrait' => 'officetalk/portraits/placeholder.webp',
            'bio_short' => fake()->sentence(12),
            'bio_long' => fake()->paragraphs(3, true),
        ];
    }
}
