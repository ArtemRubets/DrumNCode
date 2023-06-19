<?php

namespace Database\Factories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = fake()->randomElement(['todo', 'done']);

        $completedTime = $status === 'done' ? Carbon::parse(fake()->dateTimeBetween('-1 week', '+1 week')) : null;

        return [
            'status' => $status,
            'title' => fake()->words(10, true),
            'description' => fake()->sentences(3, true),
            'priority' => fake()->numberBetween(1, 10),
            'created_at' => $completedTime ? $completedTime->copy()->subDays() : Carbon::now(),
            'updated_at' => $completedTime ?: Carbon::now(),
            'completed_at' => $completedTime,
        ];
    }
}
