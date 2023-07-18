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
        $this->call([
            RunInProductionSeeder::class,
            UserSeeder::class,
            StudentSeeder::class,
            PaymentFeesSeeder::class,
            SubjectSeeder::class,
            NoticeSeeder::class,
        ]);
    }
}
