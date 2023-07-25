<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Nnjeim\World\Actions\SeedAction;
use Illuminate\Support\Facades\DB;

class WorldSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('countries')->truncate();
        DB::table('users')->truncate();

        $this->call([
            SeedAction::class,
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
