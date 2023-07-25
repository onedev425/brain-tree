<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RunInProductionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            WorldSeeder::class,
            RoleSeeder::class,
            PermissionSeeder::class,
            AdminUserSeeder::class,
            PaymentFeesSeeder::class
        ]);
    }
}
