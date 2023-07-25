<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = User::firstOrCreate([
            'id'                => 1,
            'name'              => 'Super Admin',
            'email'             => 'super@admin.com',
            'password'          => Hash::make('password'),
            'address'           => 'super admin street',
            'birthday'          => '22/04/04',
            'email_verified_at' => now(),
        ]);

        $superAdmin->assignRole('super-admin');
        $superAdmin->save();
    }
}
