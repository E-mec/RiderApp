<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'rider_id' => null,
            'pickup_location' => fake()->address,
            'delivery_location' => fake()->address,
            'status' => 'pending'
        ];
    }

    public function inTransit(): static
    {
        $riders = User::factory()->count(5)->create(['rider' => true]);
        return $this->state(fn (array $attributes) => [
            'rider_id' => $riders->random()->id,
            'status' => 'in_transit'
        ]);
    }
}
