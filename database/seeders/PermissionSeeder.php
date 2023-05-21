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

        //Permission for subject
        Permission::firstOrCreate([
            'name' => 'create subject',
        ]);
        Permission::firstOrCreate([
            'name' => 'read subject',
        ]);
        Permission::firstOrCreate([
            'name' => 'update subject',
        ]);
        Permission::firstOrCreate([
            'name' => 'delete subject',
        ]);

        //exam permissions
        Permission::firstOrCreate([
            'name' => 'create exam',
        ]);
        Permission::firstOrCreate([
            'name' => 'read exam',
        ]);
        Permission::firstOrCreate([
            'name' => 'update exam',
        ]);
        Permission::firstOrCreate([
            'name' => 'delete exam',
        ]);

        //permission for exam slots
        Permission::firstOrCreate([
            'name' => 'create exam slot',
        ]);
        Permission::firstOrCreate([
            'name' => 'read exam slot',
        ]);
        Permission::firstOrCreate([
            'name' => 'update exam slot',
        ]);
        Permission::firstOrCreate([
            'name' => 'delete exam slot',
        ]);

        //permission for exam records
        Permission::firstOrCreate([
            'name' => 'create exam record',
        ]);
        Permission::firstOrCreate([
            'name' => 'read exam record',
        ]);
        Permission::firstOrCreate([
            'name' => 'update exam record',
        ]);
        Permission::firstOrCreate([
            'name' => 'delete exam record',
        ]);

        //check result permission
        Permission::firstOrCreate([
            'name' => 'check result',
        ]);

        //permission for notices

        Permission::firstOrCreate([
            'name' => 'create notice',
        ]);

        Permission::firstOrCreate([
            'name' => 'read notice',
        ]);

        Permission::firstOrCreate([
            'name' => 'update notice',
        ]);

        Permission::firstOrCreate([
            'name' => 'delete notice',
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

        //permissions for fee categories

        Permission::firstOrCreate([
            'name' => 'create fee category',
        ]);

        Permission::firstOrCreate([
            'name' => 'read fee category',
        ]);

        Permission::firstOrCreate([
            'name' => 'update fee category',
        ]);

        Permission::firstOrCreate([
            'name' => 'delete fee category',
        ]);

        //permissions for fees

        Permission::firstOrCreate([
            'name' => 'create fee',
        ]);

        Permission::firstOrCreate([
            'name' => 'read fee',
        ]);

        Permission::firstOrCreate([
            'name' => 'update fee',
        ]);

        Permission::firstOrCreate([
            'name' => 'delete fee',
        ]);

        //permissions for fee invoices

        Permission::firstOrCreate([
            'name' => 'create fee invoice',
        ]);

        Permission::firstOrCreate([
            'name' => 'read fee invoice',
        ]);

        Permission::firstOrCreate([
            'name' => 'update fee invoice',
        ]);

        Permission::firstOrCreate([
            'name' => 'delete fee invoice',
        ]);

        //fee invoice record

        Permission::firstOrCreate([
            'name' => 'create fee invoice record',
        ]);

        Permission::firstOrCreate([
            'name' => 'read fee invoice record',
        ]);

        Permission::firstOrCreate([
            'name' => 'update fee invoice record',
        ]);

        Permission::firstOrCreate([
            'name' => 'delete fee invoice record',
        ]);

        //header permissions (for controlling the menu headers)
        Permission::firstOrCreate([
            'name' => 'header-administrate',
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
            'name' => 'menu-subject',
        ]);
        Permission::firstOrCreate([
            'name' => 'menu-exam',
        ]);
        Permission::firstOrCreate([
            'name' => 'menu-notice',
        ]);
        Permission::firstOrCreate([
            'name' => 'menu-account-application',
        ]);
        Permission::firstOrCreate([
            'name' => 'menu-fee',
        ]);
        Permission::firstOrCreate([
            'name' => 'certification-marks',
        ]);
        Permission::firstOrCreate([
            'name' => 'marks',
        ]);
        Permission::firstOrCreate([
            'name' => 'assessments',
        ]);
        Permission::firstOrCreate([
            'name' => 'pricing',
        ]);
        Permission::firstOrCreate([
            'name' => 'settings',
        ]);
        /**
         * assign permissions to roles.
         */

        //assign permissions to super-admin
        $superAdmin = Role::where('name', 'super-admin')->first();
        $superAdmin->syncPermissions([
            'header-administrate',
            'teacher-courses',
            'menu-student',
            'menu-teacher',
            'menu-subject',
            'menu-exam',
            'menu-notice',
            'menu-account-application',
            'menu-fee',
            'create student',
            'read student',
            'update student',
            'delete student',
            'create teacher',
            'read teacher',
            'update teacher',
            'delete teacher',
            'create subject',
            'read subject',
            'update subject',
            'delete subject',
            'create exam',
            'read exam',
            'update exam',
            'delete exam',
            'create exam slot',
            'read exam slot',
            'update exam slot',
            'delete exam slot',
            'create exam record',
            'read exam record',
            'update exam record',
            'delete exam record',
            'create notice',
            'read notice',
            'update notice',
            'delete notice',
            'check result',
            'read applicant',
            'update applicant',
            'delete applicant',
            'change account application status',
            'create fee',
            'read fee',
            'update fee',
            'delete fee',
            'create fee category',
            'read fee category',
            'update fee category',
            'delete fee category',
            'create fee invoice',
            'read fee invoice',
            'update fee invoice',
            'delete fee invoice',
            'create fee invoice record',
            'read fee invoice record',
            'update fee invoice record',
            'delete fee invoice record',
            'marks',
            'assessments',
            'pricing',
            'settings',
        ]);

        //assign permissions to teacher
        $teacher = Role::where('name', 'teacher')->first();
        $teacher->syncPermissions([
            'header-administrate',
            'teacher-courses',
            'menu-exam',
            'menu-notice',
            'menu-student',
            'read student',
            'read exam',
            'read exam slot',
            'create exam record',
            'read exam record',
            'update exam record',
            'delete exam record',
            'read notice',
            'check result',
            'marks',
            'assessments',
            'pricing',
            'settings',
        ]);

        //assign permissions to student
        $student = Role::where('name', 'student')->first();
        $student->syncPermissions([
            'header-administrate',
            'student-courses',
            'menu-fee',
            'menu-notice',
            'menu-exam',
            'read notice',
            'read fee invoice',
            'check result',
            'certification-marks',
            'pricing',
            'settings',
        ]);
    }
}