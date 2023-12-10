<?php

namespace Database\Seeders;

use App\Models\CollectionElement;
use App\Models\User;
use App\Models\CollectionEntity;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // password = "password"
        $testUserOne = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $testEntityOne = CollectionEntity::factory()->create([
            'user_id' => $testUserOne->id,
            'goal' => 15,
        ]);

        CollectionElement::factory(10)->create([
            'collection_entity_id' => $testEntityOne->id,
        ]);

        $testEntityTwo = CollectionEntity::factory()->create([
            'user_id' => $testUserOne->id,
            'goal' => 20,
        ]);

        CollectionElement::factory(10)->create([
            'collection_entity_id' => $testEntityTwo->id,
        ]);

        CollectionEntity::factory(2)->create([
            'user_id' => $testUserOne->id
        ]);

        $testUserTwo = User::factory()->create([
            'name' => 'Another User',
            'email' => 'another@example.com',
        ]);

        CollectionEntity::factory(10)->create([
            'user_id' => $testUserTwo->id
        ]);
    }
}
