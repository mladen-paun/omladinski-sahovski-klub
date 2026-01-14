<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LekcijaFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'naziv' => fake()->regexify('[A-Za-z0-9]{50}'),
            'deo_partije' => fake()->text(),
        ];
    }
}
