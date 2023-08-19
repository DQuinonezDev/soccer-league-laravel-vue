<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Equipo>
 */
class TeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $names = ['Equipo A', 'Equipo B', 'Equipo C'];
        return [
            'name' => $this->faker->randomElement($names),
            'country' => "España",
            'img' => "https://upload.wikimedia.org/wikipedia/commons/7/74/Borussia_Dortmund.png",
        ];
    }
}
