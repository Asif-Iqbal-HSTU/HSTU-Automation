<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramLearningOutcomesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $programLearningOutcomes = [
            ['PLO_No' => 'PLO 1', 'PLO_Description' => 'Description for PLO-1'],
            ['PLO_No' => 'PLO 2', 'PLO_Description' => 'Description for PLO-2'],
            ['PLO_No' => 'PLO 3', 'PLO_Description' => 'Description for PLO-3'],
            ['PLO_No' => 'PLO 4', 'PLO_Description' => 'Description for PLO-4'],
            ['PLO_No' => 'PLO 5', 'PLO_Description' => 'Description for PLO-5'],
            ['PLO_No' => 'PLO 6', 'PLO_Description' => 'Description for PLO-6'],
            ['PLO_No' => 'PLO 7', 'PLO_Description' => 'Description for PLO-7'],
            ['PLO_No' => 'PLO 8', 'PLO_Description' => 'Description for PLO-8'],
            ['PLO_No' => 'PLO 9', 'PLO_Description' => 'Description for PLO-9'],
            ['PLO_No' => 'PLO 10', 'PLO_Description' => 'Description for PLO-10'],
            ['PLO_No' => 'PLO 11', 'PLO_Description' => 'Description for PLO-11'],
            ['PLO_No' => 'PLO 12', 'PLO_Description' => 'Description for PLO-12'],
        ];

        DB::table('program_learning_outcomes')->insert($programLearningOutcomes);
    }
}
