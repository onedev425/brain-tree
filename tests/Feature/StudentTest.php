<?php

namespace Tests\Feature;

use App\Models\StudentRecord;
use App\Models\User;
use App\Traits\FeatureTestTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StudentTest extends TestCase
{
    use RefreshDatabase;
    use FeatureTestTrait;
    use WithFaker;

    //test view all students cannot be accessed by unauthorised users

    public function test_view_all_students_cannot_be_accessed_by_unauthorised_users()
    {
        $this->unauthorized_user()->get('dashboard/students/')->assertForbidden();
    }

    //test view all students can be accessed by authorised users

    public function test_view_all_students_can_be_accessed_by_authorised_users()
    {
        $this->authorized_user(['read student'])->get('dashboard/students')->assertOk();
    }

    //test create student cannot be accessed by unauthorised users

    public function test_create_student_cannot_be_accessed_by_unauthorised_users()
    {
        $this->unauthorized_user()->get('dashboard/students/create')->assertForbidden();
    }

    //test create student can be accessed by authorised users

    public function test_create_student_can_be_accessed_by_authorised_users()
    {
        $this->authorized_user(['create student'])->get('dashboard/students/create')->assertOk();
    }

    //test unauthorised users cannot create students

    public function test_unauthorised_users_cannot_create_students()
    {
        $email = $this->faker()->freeEmail();
        $this->unauthorized_user()->post('dashboard/students', [
            'first_name'            => 'Test',
            'last_name'             => 'Student',
            'other_name'            => 'cody',
            'email'                 => $email,
            'password'              => 'password',
            'password_confirmation' => 'password',
            'gender'                => 'male',
            'state'                 => 'lagos',
            'city'                  => 'lagos',
            'address'               => 'test address',
            'birthday'              => '2004/04/22',
            'phone'                 => '08080808080',
            'admission_date'        => '2004/04/22',
        ])->assertForbidden();

        $this->assertDatabaseMissing('users', [
            'email' => $email,
        ]);
    }

    //test user can create student

    public function test_authorized_user_can_create_student()
    {
        $email = $this->faker()->freeEmail();

        $this->authorized_user(['create student'])->post('dashboard/students', [
            'first_name'            => 'Test',
            'last_name'             => 'Student',
            'other_name'            => 'cody',
            'email'                 => $email,
            'password'              => 'password',
            'password_confirmation' => 'password',
            'gender'                => 'male',
            'state'                 => 'lagos',
            'city'                  => 'lagos',
            'address'               => 'test address',
            'birthday'              => '2004/04/22',
            'phone'                 => '08080808080',
            'admission_date'        => '2004/04/22', ]);

        $this->assertDatabaseHas('users', [
            'email'    => $email,
            'address'  => 'test address',
            'birthday' => '2004/04/22',
            'phone'    => '08080808080',
        ]);
    }

    //test edit student cannot be accessed by unauthorised users

    public function test_edit_student_cannot_be_accessed_to_unauthorised_users()
    {
        $student = StudentRecord::factory()->create();
        $this->unauthorized_user()->get('dashboard/students/'.$student->user->id.'/edit')->assertForbidden();
    }

    //test edit student can be accessed by authorised users

    public function test_edit_student_can_be_accessed_by_authorised_users()
    {
        $student = StudentRecord::factory()->create();
        $this->authorized_user(['update student'])->get('dashboard/students/'.$student->user->id.'/edit')->assertOk();
    }

    public function test_unauthorised_users_cannot_update_students()
    {
        $email = $this->faker()->freeEmail();

        $student = StudentRecord::factory()->create();

        $this->unauthorized_user()->put('dashboard/students/'.$student->user->id, [
            'first_name'            => 'Test',
            'last_name'             => 'Student 2',
            'email'                 => $email,
            'password'              => 'password',
            'password_confirmation' => 'password',
            'gender'                => 'male',
            'state'                 => 'lagos',
            'city'                  => 'lagos',
            'address'               => 'test address',
            'birthday'              => '2004/04/22',
            'phone'                 => '08080808080',
            'admission_date'        => '2004/04/22', ])
        ->assertForbidden();

        $this->assertDatabaseMissing('users', [
            'email' => $email,
        ]);
    }

    public function test_authorised_users_can_update_students()
    {
        $student = StudentRecord::factory()->create();
        $email = $this->faker()->freeEmail();

        $this->authorized_user(['update student'])->put('dashboard/students/'.$student->user->id, [
            'first_name'            => 'Test 2',
            'other_names'           => 'Student 2',
            'last_name'             => 'Student',
            'email'                 => $email,
            'password'              => 'password',
            'password_confirmation' => 'password',
            'gender'                => 'male',
            'state'                 => 'lagos',
            'city'                  => 'lagos',
            'address'               => 'test address',
            'birthday'              => '2004/04/22',
            'phone'                 => '08080808080',
        ]);

        $this->assertDatabaseHas('users', [
            'email' => $email,
        ]);
    }

    //test unauthorised users cannot delete students

    public function test_unauthorised_users_cannot_delete_students()
    {
        $student = StudentRecord::factory()->create();
        $this->unauthorized_user()
            ->delete('dashboard/students/'.$student->user->id)
            ->assertForbidden();

        $this->assertModelExists($student->user) && $this->assertNotSoftDeleted($student->user);
    }

    //test authorised users can delete students

    public function test_authorised_users_can_delete_students()
    {
        $student = StudentRecord::factory()->create();
        $this->authorized_user(['delete student'])->delete('dashboard/students/'.$student->user->id);

        $this->assertModelExists($student->user) && $this->assertSoftDeleted($student->user);
    }

    //test unauthorized user cannot view all graduations

    public function test_unauthorized_user_cannot_view_all_graduations()
    {
        $this->unauthorized_user()->get('dashboard/students/graduations')->assertForbidden();
    }

    //test authorized user can view all graduations

    public function test_authorized_user_can_view_all_graduations()
    {
        $this->authorized_user(['view graduations'])->get('dashboard/students/graduations')->assertOk();
    }

    //test unauthorized user cannot graduate student

    public function test_unauthorized_user_cannot_graduate_student()
    {
        $student = StudentRecord::factory()->create();
        $this->unauthorized_user()->post('/dashboard/students/graduate', [
            'student_id' => [$student->user->id],
        ])->assertForbidden();
    }
}
