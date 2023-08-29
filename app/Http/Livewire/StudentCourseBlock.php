<?php

namespace App\Http\Livewire;

use Livewire\Component;

class StudentCourseBlock extends Component
{
    public $course_id;
    public $title;
    public $image;
    public $teacher;
    public $lesson_nums;
    public $quiz_nums;
    public $progress;
    public $rate;
    public int $feedback_nums;
    public bool $available;

    public function render()
    {
        return view('livewire.student-course-block');
    }
}
