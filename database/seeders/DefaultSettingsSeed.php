<?php

namespace Database\Seeders;

use App\Models\DefaultSetting;
use Illuminate\Database\Seeder;

class DefaultSettingsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DefaultSetting::create([
            'currency' => 'AOA',
            'currency_simbol' => 'Kz',
            'app_tax_percent' => '10'
        ]);
    }
}
