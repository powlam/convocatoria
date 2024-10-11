<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Meeting>
 */
class MeetingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->text();

        return [
            'name' => $name,
            'when' => fake()->dateTime(),
            'where' => fake()->address(),
            'slug' => Str::slug($name),
            'user_id' => User::factory(),
        ];
    }
}
