<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TrenerFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'ime' => fake()->regexify('[A-Za-z0-9]{30}'),
            'prezime' => fake()->regexify('[A-Za-z0-9]{30}'),
            'broj_telefona' => fake()->regexify('[A-Za-z0-9]{17}'),
            'jmbg' => fake()->regexify('[A-Za-z0-9]{13}'),
        ];
    }
}
