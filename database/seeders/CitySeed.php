<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::create([
            'city' => 'Luanda',
            'province_id' => 1,
        ]);
        City::create([
            'city' => 'Viana',
            'province_id' => 1,
        ]);
        City::create([
            'city' => 'Lubango',
            'province_id' => 3,
        ]);
    }
}
