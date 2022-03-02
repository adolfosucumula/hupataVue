<?php

namespace Database\Seeders;

use App\Models\CategoryKnowledges;
use Illuminate\Database\Seeder;

class CategoryKnowledgeSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CategoryKnowledges::create([
            'category' => 'TI, Software',
        ]);
    }
}
