<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::firstOrCreate([
            'name' => 'super-admin',
        ]);
        Role::firstOrCreate([
            'name' => 'teacher',
        ]);
        Role::firstOrCreate([
            'name' => 'student',
        ]);
        Role::firstOrCreate([
            'name' => 'applicant',
        ]);
    }
}
