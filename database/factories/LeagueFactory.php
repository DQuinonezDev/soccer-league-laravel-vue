<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Liga>
 */
class LeagueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $names = ['Bundesliga', 'Laliga', 'Serie C'];
        return [
            'name' => $this->faker->randomElement($names),
            'img' => "https://go.memtis.com/bundesliga-logo",
        ];
    }
}
