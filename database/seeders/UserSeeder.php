<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        $superAdmin = User::firstOrCreate([
            'id'                => 1,
            'name'              => 'John Doe',
            'email'             => 'super@admin.com',
            'password'          => Hash::make('password'),
            'address'           => 'super admin street',
            'birthday'          => '22/04/04',
            'email_verified_at' => now(),
        ]);

        $superAdmin->assignRole('super-admin');
        $superAdmin->save();

        $teacher = User::create([
            'id'                => 3,
            'name'              => 'John Doe',
            'email'             => 'teacher@teacher.com',
            'password'          => Hash::make('password'),
            'address'           => 'teacher street',
            'birthday'          => '22/04/04',
            'email_verified_at' => now(),

        ]);

        $teacher->assignRole('teacher');

        $teacher->teacherRecord()->create([
            'user_id' => $teacher->id,
        ]);

        $student = User::create([
            'id'                => 4,
            'name'              => 'Jane Doe',
            'email'             => 'student@student.com',
            'password'          => Hash::make('password'),
            'address'           => 'student street',
            'birthday'          => '22/04/04',
            'email_verified_at' => now(),
        ]);
        $student->studentRecord()->create([
            'admission_date'   => '22/04/04',
            'is_graduated'     => false,
            'admission_number' => Str::random(10),
        ]);

        $student->assignRole('student');
    }
}
