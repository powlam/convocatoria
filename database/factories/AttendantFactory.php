<?php

namespace Database\Factories;

use App\Models\Meeting;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attendant>
 */
class AttendantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'meeting_id' => Meeting::factory(),
            'name' => fake()->firstName(),
            'willBeAttending' => fake()->boolean() ? fake()->boolean() : null,
            'note' => fake()->boolean() ? fake()->paragraph() : null,
        ];
    }
}
