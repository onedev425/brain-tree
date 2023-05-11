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
            SubjectSeeder::class,
            ExamSeeder::class,
            GradeSystemSeeder::class,
            ExamSlotSeeder::class,
            NoticeSeeder::class,
            FeeCategorySeeder::class,
            FeeSeeder::class,
            FeeInvoiceSeeder::class,
            FeeInvoiceRecordSeeder::class,
        ]);
    }
}
