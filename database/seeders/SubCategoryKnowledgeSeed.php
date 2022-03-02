<?php

namespace Database\Seeders;

use App\Models\SubCategoryKnowledge;
use Illuminate\Database\Seeder;

class SubCategoryKnowledgeSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SubCategoryKnowledge::create([
            'sub_knowledge' => 'CSS',
            'knowledge_id' => 1,
        ]);
        SubCategoryKnowledge::create([
            'sub_knowledge' => 'HTML+5',
            'knowledge_id' => 1,
        ]);
        SubCategoryKnowledge::create([
            'sub_knowledge' => 'Vue JS',
            'knowledge_id' => 1,
        ]);
        SubCategoryKnowledge::create([
            'sub_knowledge' => 'React JS',
            'knowledge_id' => 1,
        ]);
        SubCategoryKnowledge::create([
            'sub_knowledge' => 'Angular JS',
            'knowledge_id' => 1,
        ]);
        SubCategoryKnowledge::create([
            'sub_knowledge' => 'Node JS',
            'knowledge_id' => 1,
        ]);
        SubCategoryKnowledge::create([
            'sub_knowledge' => 'Laravel',
            'knowledge_id' => 1,
        ]);
        SubCategoryKnowledge::create([
            'sub_knowledge' => 'Adonis JS',
            'knowledge_id' => 1,
        ]);
        SubCategoryKnowledge::create([
            'sub_knowledge' => 'Web Development',
            'knowledge_id' => 1,
        ]);
        SubCategoryKnowledge::create([
            'sub_knowledge' => 'Java Development',
            'knowledge_id' => 1,
        ]);
    }
}
