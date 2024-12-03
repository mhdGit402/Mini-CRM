<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::pluck('id');
        $client = Client::pluck('id');

        return [
            'title' => fake()->word(),
            'description' => fake()->paragraph(),
            'user_id' => $user->random(),
            'client_id' => $client->random(),
            'deadline_at' => fake()->dateTimeBetween('now', '+1 year'), // Generates a random date between now and one year from now,
            'status' => $this->faker->randomElement(['open', 'in progress', 'blocked', 'cancelled', 'completed']),
        ];
    }
}
