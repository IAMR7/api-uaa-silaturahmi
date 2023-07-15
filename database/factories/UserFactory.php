<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'username' => fake()->username(),
            'email' => fake()->unique()->safeEmail(),
            'password' => bcrypt("password123"),
            'phone' => fake()->phoneNumber(),
            'bio' => "Lorem ipsum dolor sit amet",
            'gender' => "Laki-laki",
            'major_id' => fake()->numberBetween(1, 18),
            'status_id' => fake()->numberBetween(1, 5),
            'year_generation' => fake()->year('-5 years'),
            'role_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
