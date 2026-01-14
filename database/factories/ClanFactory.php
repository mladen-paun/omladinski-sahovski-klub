<?php

namespace Database\Factories;

use App\Models\Kategorija;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClanFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'ime' => fake()->regexify('[A-Za-z0-9]{30}'),
            'prezime' => fake()->regexify('[A-Za-z0-9]{30}'),
            'godina_rodjenja' => fake()->date(),
            'fide_rejting' => fake()->randomFloat(0, 0, 9999999999.),
            'kategorija_id' => Kategorija::factory(),
        ];
    }
}
