<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Create all permissions.
         *
         * EVERYTHING HERE IS USED IN A SINGULAR SENSE
         */

        //Permission for students
        Permission::firstOrCreate([
            'name' => 'create student',
        ]);
        Permission::firstOrCreate([
            'name' => 'read student',
        ]);
        Permission::firstOrCreate([
            'name' => 'update student',
        ]);
        Permission::firstOrCreate([
            'name' => 'delete student',
        ]);

        //Permission for teacher
        Permission::firstOrCreate([
            'name' => 'create teacher',
        ]);
        Permission::firstOrCreate([
            'name' => 'read teacher',
        ]);
        Permission::firstOrCreate([
            'name' => 'update teacher',
        ]);
        Permission::firstOrCreate([
            'name' => 'delete teacher',
        ]);

        //permission for applicant
        Permission::firstOrCreate([
            'name' => 'read applicant',
        ]);

        Permission::firstOrCreate([
            'name' => 'update applicant',
        ]);

        Permission::firstOrCreate([
            'name' => 'delete applicant',
        ]);

        Permission::firstOrCreate([
            'name' => 'change account application status',
        ]);

        Permission::firstOrCreate([
            'name' => 'teacher-courses',
        ]);
        Permission::firstOrCreate([
            'name' => 'student-courses',
        ]);
        Permission::firstOrCreate([
            'name' => 'menu-student',
        ]);
        Permission::firstOrCreate([
            'name' => 'menu-teacher',
        ]);
        Permission::firstOrCreate([
            'name' => 'menu-account-application',
        ]);
        Permission::firstOrCreate([
            'name' => 'certification-marks',
        ]);
        Permission::firstOrCreate([
            'name' => 'marks',
        ]);
        Permission::firstOrCreate([
            'name' => 'pricing',
        ]);
        Permission::firstOrCreate([
            'name' => 'settings',
        ]);
        Permission::firstOrCreate([
            'name' => 'menu-industry',
        ]);
        /**
         * assign permissions to roles.
         */

        //assign permissions to super-admin
        $superAdmin = Role::where('name', 'super-admin')->first();
        $superAdmin->syncPermissions([
            'teacher-courses',
            'menu-student',
            'menu-teacher',
            'menu-account-application',
            'create student',
            'read student',
            'update student',
            'delete student',
            'create teacher',
            'read teacher',
            'update teacher',
            'delete teacher',
            'read applicant',
            'update applicant',
            'delete applicant',
            'change account application status',
            'marks',
            'pricing',
            'settings',
            'menu-industry',
        ]);

        //assign permissions to teacher
        $teacher = Role::where('name', 'teacher')->first();
        $teacher->syncPermissions([
            'teacher-courses',
            'menu-student',
            'read student',
            'marks',
            'pricing',
            'settings',
        ]);

        //assign permissions to student
        $student = Role::where('name', 'student')->first();
        $student->syncPermissions([
            'student-courses',
            'certification-marks',
            'pricing',
            'settings',
        ]);
    }
}
