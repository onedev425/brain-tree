<?php

namespace Database\Factories;

use App\Models\StudentRecord;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class StudentRecordFactory extends Factory
{
    protected $model = StudentRecord::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $student = User::factory()->create();
        $student->assignRole('student');

        return [
            'user_id'          => $student->id,
            'admission_date'   => $this->faker->date(),
            'is_graduated'     => false,
            'admission_number' => Str::random(10),
        ];
    }
}
