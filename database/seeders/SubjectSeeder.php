<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subject::firstOrCreate([
            'id' => 1,
        ], [
            'name'        => 'Maths',
            'short_name'  => 'mat',
        ]);

        Subject::firstOrCreate([
            'name'        => 'English',
            'short_name'  => 'eng',
        ]);
    }
}
