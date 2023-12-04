<?php

namespace Database\Factories;

use App\Models\CollectionEntity;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CollectionEntity>
 */
class CollectionEntityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(3),
            'description' => $this->faker->paragraph(5),
            'goal' => $this->faker->randomNumber(1),
        ];
    }
}
