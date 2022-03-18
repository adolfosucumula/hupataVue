<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            UserSeed::class,
            CountrySeed::class,
            ProvinceSeed::class,
            CitySeed::class,
            CategoryKnowledgeSeed::class,
            SubCategoryKnowledgeSeed::class,
            DefaultSettingsSeed::class,
        ]);
    }
}
