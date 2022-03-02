<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Seeder;

class ProvinceSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Province::create([
            'country_id' => 1,
            'province' => 'Luanda',
        ]);
        Province::create([
            'country_id' => 1,
            'province' => 'Huambo',
        ]);
        Province::create([
            'country_id' => 1,
            'province' => 'Huíla',
        ]);
    }
}
