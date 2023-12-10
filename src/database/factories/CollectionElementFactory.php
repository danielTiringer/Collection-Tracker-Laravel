<?php

namespace Database\Factories;

use App\Enums\CollectionElementStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CollectionElement>
 */
class CollectionElementFactory extends Factory
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
            'status' => $this->faker->randomElement(CollectionElementStatus::class),
        ];
    }
}
