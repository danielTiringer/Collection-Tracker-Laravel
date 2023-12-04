<?php

namespace Database\Seeders;

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
         User::factory(10)->create();
         CollectionEntity::factory(10)->create();
    }
}
